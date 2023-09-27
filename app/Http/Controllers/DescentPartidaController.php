<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use App\Library\Respuesta;
use App\Library\Comprobaciones;
use App\Models\CartaOverlordDc;
use App\Models\ClaseDc;
use App\Models\Descent;
use App\Models\EquipamientoDc;
use App\Models\HeroeDc;
use App\Models\MisionDc;
use App\Models\PartidasJuegos;
use App\Models\PartyDc;
use League\CommonMark\Extension\Table\Table;

use function PHPUnit\Framework\isEmpty;

class DescentPartidaController extends Controller
{
    ///////////////////////////////////////////////////////////////////////
    //////////////                CREATE                     //////////////
    ///////////////////////////////////////////////////////////////////////

    public function crearPartidaDescent(Request $request){

        $request->validate([
            'nombre_partida' => ['required','string','min:2','max:40','regex:/^[a-zA-Z ]+$/'],
        ]);

        $respuesta = new Respuesta();

        // nombre_partida, correo_usuario, oro, id_mision_dc
        try{
            $partida = new PartidasJuegos();
            $partida->nombre_partida = $request->nombre_partida;
            $partida->correo_usuario = auth()->user()->correo_usuario;
            $partida->nombre_imagen = "Descent";
            $partida->save();

            $descent = new Descent();
            $descent->oro = $request->oro;
            $descent->id_partida_general = $partida->id;
            $descent->id_mision_dc = $request->id_mision_dc;
            $descent->save();
             
             
            $this->crearHeroePartidaDescent($descent->id);

            $respuesta->setRespuestaExito($respuesta, $partida);

        } catch(\Exception $e){
            //dd(DB::table('administradores')->select('administradores.dni_admin')->where('dni_admin', $request->dni_admin)->first());
            $respuesta->setRespuestaErrorGeneral($respuesta);
        }

        return response()->json($respuesta);
    }

    public function crearHeroePartidaDescent($id_partida_descent){

        $respuesta = new Respuesta();

        try{

            $partidaDescent = Descent::find($id_partida_descent);
            $maximodeHeroes = PartyDc::where('id_partida_dc' , $partidaDescent->id)->get();

            if($maximodeHeroes->count() >= 4){
                $respuesta->setRespuestaMaximoHeroesAlcanzado($respuesta);
            } else {
                $party = new PartyDc();

                $party->id_partida_dc = $partidaDescent->id;
                $party->id_heroe_dc = 1;
                $party->save(); 
    
                $respuesta->setRespuestaExito($respuesta, $party);
            }


        } catch(\Exception $e){
            $respuesta->setRespuestaErrorGeneral($respuesta);
        }

        return response()->json($respuesta);
    }


    ///////////////////////////////////////////////////////////////////////
    //////////////                 READ                      //////////////
    ///////////////////////////////////////////////////////////////////////


    public function verGeneralPartidaDescent($id_partida_descent){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        $data = [];

        // 1- Obtener datos generales de la partida
        $partidaDescent = Descent::find($id_partida_descent);

        try{  
            // Usuario con sesión iniciada posee la partida
            if ($comprobaciones->checkActualUserIsUser() 
            && ($comprobaciones->partidaPerteneceUsuarioActual($partidaDescent->id_partida_general))){
        
                // 2- Obtener cartas del Overlord
                if(!$partidaDescent->cartas()->first()){

                    $CartasOverlord[0] = "Sin cartas";

                } else{
                    $CartasOverlord = [];
                    $count = 0;
                    foreach($partidaDescent->cartas()->get() as $carta){
                        //dd($carta->nombre_carta);
                        $CartasOverlord[$count] = $carta->nombre_carta;
                        $count++;
                    }
                }

                    //dd($CartasOverlord);

                // 3- Obtener misión actual y nombre de la partida
                $misionActual = MisionDc::select('nombre_mision_dc')->where('id' , $partidaDescent->id_mision_dc)->first();
                $partida = PartidasJuegos::select('nombre_partida')->where('id',$partidaDescent->id_partida_general)->first();


                // 5- Guardar junta toda la información
                $data[0] = $partida->nombre_partida;
                $data[1] = $partidaDescent->oro;
                $data[2] = $misionActual->nombre_mision_dc;
                $data[3] = $CartasOverlord;
                    //dd($data);
                
                $respuesta->setRespuestaExito($respuesta, $data);
                
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }
           
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }

    public function verHeroePartidaDescent($id_partida_descent){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        $data = [];

        // 1- Obtener datos generales de la partida
        $partidaDescent = Descent::find($id_partida_descent);

        try{  
            // Usuario con sesión iniciada posee la partida
            if ($comprobaciones->checkActualUserIsUser() 
            && ($comprobaciones->partidaPerteneceUsuarioActual($partidaDescent->id_partida_general))){
        
                



                // 2- Obtener parties de la partida
                $arrayParties = PartyDc::where('id_partida_dc' , $partidaDescent->id)->get();


                // 3- Obtener información de cada héroe
                $count = 0;
                foreach($arrayParties as $heroeIndividual){
                    $nombresHeroes = [];
                    $habilidades = [];
                    $equipamientos = [];

                    // Nombre del héroe
                    $aux = HeroeDc::find($heroeIndividual->id_heroe_dc);
                    $nombresHeroes[$count] = $aux->nombre_heroe_dc;

                    // Habilidades de la Clase y Nombre de la clase
                    $aux = PartyDc::find($heroeIndividual->id);
  
                    if(!$aux->clases()->first()){

                        $habilidades[0] = "Ninguna";
                        $tituloClase = "Sin Clase";

                    } else{

                        $count2 = 0;
                        foreach($aux->clases()->get() as $clase){
                            
                            $habilidades[$count2] = $clase->nombre_clase_dc;
                            $count2++;
                        }
    
                        $auxtituloClase = ClaseDc::select('titulo_clase_dc')->where('nombre_clase_dc' , $habilidades[0])->first();
                        $tituloClase = $auxtituloClase->titulo_clase_dc;
                    }
                    
                    // Equipamiento del héroe
                    if(!$aux->clases()->first()){

                        $equipamientos[0] = "Sin equipo";

                    } else{
                    
                    $aux = PartyDc::find($heroeIndividual->id);
                    
                    $count3 = 0;
                        foreach($aux->equipamientos()->get() as $equipo){
                            //dd($carta->nombre_carta);
                            $equipamientos[$count3] = $equipo->nombre_equipamiento_dc;
                            $count3++;
                        }
                    }


                    // 4- Guardar junta toda la información
                    $data[$count][0] = $nombresHeroes;
                    $data[$count][1] = $tituloClase;
                    $data[$count][2] = $habilidades;
                    //$data[$count][3] = $equipamientos;

                    $count++;
                }

                //dd($data);
                
                $respuesta->setRespuestaExito($respuesta, $data);
                
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }
            
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }


    ///////////////////////////////////////////////////////////////////////
    //////////////                READ_ALL                   //////////////
    ///////////////////////////////////////////////////////////////////////

    public function listarPartidasDescent($id_usuario){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        try{  
            // Solo se puede hacer si es el usuario al cual pertenece el id
            if ($comprobaciones->checkIDUsuarioActual($id_usuario)){
        
                //dd("df");
                $correo = $comprobaciones->obtenerCorreoUsuario($id_usuario);
                //dd($correo);
                $partidaList = PartidasJuegos::where('correo_usuario' , $correo)->where('nombre_imagen', 'Descent')->get();
                
                $respuesta->setRespuestaExito($respuesta, $partidaList);
                
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }
            
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }

    ///////////////////////////////////////////////////////////////////////
    //////////////                UPDATE                     //////////////
    ///////////////////////////////////////////////////////////////////////


    public function actualizarGeneralPartidaDescent(Request $request, $id_partida_descent){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        $dataNueva = [];  

        // 1- Obtener datos generales de la partida
        $partidaDescent = Descent::find($id_partida_descent);
   
        try{  
            // Usuario con sesión iniciada posee la partida
            if ($comprobaciones->checkActualUserIsUser() 
            && ($comprobaciones->partidaPerteneceUsuarioActual($partidaDescent->id_partida_general))){
        
                
                
                $partida = PartidasJuegos::find($partidaDescent->id_partida_general);
                
                
                // 2- Actualizar la partida
                $nuevamision = MisionDc::select('id')->where('nombre_mision_dc' , $request->nombre_mision_dc)->first();
                
                $partidaDescent->oro = $request->oro;
                $partidaDescent->id_mision_dc = $nuevamision->id;
                $partidaDescent->save();

                $partida->nombre_partida = $request->nombre_partida;
                $partida->save();

                // 3- Actualizar mazo de cartas del Overlord de la partida.
                $count = 0;
                $cartasOverlord = [];
                
                foreach($request->cartasOverlord as $carta){
                    
                    $aux = CartaOverlordDc::select('id')->where('nombre_carta' , $carta)->first();
                    $cartasOverlord[$count] = $aux->id;
                    $count++;
                }

                $partidaDescent->cartas()->sync($cartasOverlord);

                

                // 4- Mostrar toda la información
                $dataNueva[0] = $partida->nombre_partida;
                $dataNueva[1] = $partidaDescent->oro;
                $dataNueva[2] = $partidaDescent->id_mision_dc;
                $dataNueva[3] = $partida->correo_usuario;
                $dataNueva[4] = $partidaDescent->cartas()->allRelatedIds();

                $respuesta->setRespuestaExito($respuesta, $dataNueva);
                
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }
            
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }

    public function actualizarHeroePartidaDescent(Request $request, $id_partida_descent, $id_heroe){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        $dataNueva = [];  

        // 1- Obtener datos generales de la partida
        $partidaDescent = Descent::find($id_partida_descent);

        // Usuario con sesión iniciada posee la partida
        if ($comprobaciones->checkActualUserIsUser() 
        && ($comprobaciones->partidaPerteneceUsuarioActual($partidaDescent->id_partida_general))){

            // 2- Obtener parties de la partida
            $heroe = PartyDc::where('id_partida_dc' , $partidaDescent->id)->where('id_heroe_dc' , $id_heroe)->first();

            // 3- Obtener información del héroe
            // habilidades_clase [], equipo_heroe [], id_heroe_dc

            $heroe->id_heroe_dc = $request->id_heroe_dc;

            // Habilidades del heroe
            $habilidadesHeroe = PartyDc::find($heroe->id);
            
            if(emptyArray($request->habilidades_clase)){

                $habilidadesHeroe->clases()->detach();

            } else{
                $habilidadesNuevas = [];
                $count2 = 0;
                foreach($request->habilidades_clase as $habilidadNueva){
                    $aux = ClaseDc::select('id')->where('nombre_clase_dc' , $habilidadNueva)->first();
                    $habilidadesNuevas[$count2] = $aux->id;
                    $count2++;
                }

                $habilidadesHeroe->clases()->sync($habilidadesNuevas);
            }

            // Equipo del heroe
            $equipoHeroe = PartyDc::find($heroe->id);

            if(emptyArray($request->equipoHeroe)){

                $equipoHeroe->equipamientos()->detach();

            } else{
                $equipoNuevo = [];
                $count2 = 0;
                foreach($request->equipo_heroe as $equipo){
                    $aux = EquipamientoDc::select('id')->where('nombre_equipamiento_dc' , $equipo)->first();
                    $equipoNuevo[$count2] = $aux->id;
                    $count2++;
                }

                $equipoHeroe->equipamientos()->sync($equipoNuevo);
            }

            // 4- Mostrar toda la información
            $dataNueva[0] = $heroe->id_heroe_dc;
            $dataNueva[1] = $habilidadesHeroe->clases()->allRelatedIds();
            $dataNueva[2] = $equipoHeroe->clases()->allRelatedIds();

            $respuesta->setRespuestaExito($respuesta, $dataNueva);

        } else {

            $respuesta->setRespuestaErrorSinPermisos($respuesta);
            return response()->json($respuesta);
        }
    }



    ///////////////////////////////////////////////////////////////////////
    //////////////                DELETE                     //////////////
    ///////////////////////////////////////////////////////////////////////

    public function eliminarPartidaDescent($id_partida_descent){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        
        try{
            
            if($comprobaciones->checkActualUserIsUser()){
                
                $partidaDescent = Descent::findOrFail($id_partida_descent);
                $partida = PartidasJuegos::findOrFail($partidaDescent->id_partida_general);

                $partida->delete();
    
                $respuesta->setRespuestaExito($respuesta, $partida);
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }

        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }

    public function eliminarHeroePartidaDescent($id_party){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        
        try{
            
            if($comprobaciones->checkActualUserIsUser()){
                
                $partidaDescent = PartyDc::findOrFail($id_party);
                
                $partidaDescent->delete();
    
                $respuesta->setRespuestaExito($respuesta, $partidaDescent);
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }

        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }


















    public function testsync(){

        $overlord = PartyDc::find(1);

        // SHOW
        $array = [];
        $count = 0;
        
        foreach($overlord->clases()->get() as $carta){
            //dd($carta->nombre_carta);
            $array[$count] = $carta->nombre_clase_dc;
            $count++;
        }
        dd($array);


        // UPDATE
        $cartas = [18];
        $overlord->clases()->sync($cartas);

        

        dd($overlord->clases()->get());
    }
    
}
