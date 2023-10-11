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
            // Usuario con sesión iniciada posee la partida o es un administrador
            if (
                ($comprobaciones->checkActualUserIsUser() && ($comprobaciones->partidaPerteneceUsuarioActual($partidaDescent->id_partida_general))) ||
                $comprobaciones->checkActualUserIsAdmin()
                ){
        
                // 2- Obtener cartas del Overlord
                if(!$partidaDescent->cartas()->first()){

                    $CartasOverlord[0] = "";

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

    // Todos los héroes de la partida
    public function verHeroePartidaDescent($id_partida_descent){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        $data = [];

        // 1- Obtener datos generales de la partida
        $partidaDescent = Descent::find($id_partida_descent);

        try{  
            // Usuario con sesión iniciada posee la partida
            if (
                ($comprobaciones->checkActualUserIsUser() && ($comprobaciones->partidaPerteneceUsuarioActual($partidaDescent->id_partida_general))) ||
                $comprobaciones->checkActualUserIsAdmin()
                ){
                



                // 2- Obtener parties de la partida
                $arrayParties = PartyDc::where('id_partida_dc' , $partidaDescent->id)->get();


                // 3- Obtener información de cada héroe
                $count = 0;
                foreach($arrayParties as $heroeIndividual){
                    $nombresHeroes = [];
                    $nombresClases = [];
                    $habilidades = [];
                    $equipamientos = [];

                    // Nombre del héroe
                    $aux = HeroeDc::find($heroeIndividual->id_heroe_dc);
                    $nombresHeroes = $aux->nombre_heroe_dc;

                    // Habilidades de la Clase y Nombre de la clase
                    $aux = PartyDc::find($heroeIndividual->id);
  
                    if(!$aux->clases()->first()){

                        $habilidades[0] = "";
                        $tituloClase = "Sin Clase";

                    } else{

                        $count2 = 0;
                        foreach($aux->clases()->get() as $clase){
                            
                            $habilidades[$count2] = $clase->nombre_clase_dc;
                            $count2++;
                        }
    
                        $auxtituloClase = ClaseDc::select('titulo_clase_dc')->where('nombre_clase_dc' , $habilidades[0])->first();
                        $nombresClases = $auxtituloClase->titulo_clase_dc;
                    }
                    
                    // Equipamiento del héroe
                    if(!$aux->clases()->first()){

                        $equipamientos[0] = "";

                    } else{
                    
                    $aux = PartyDc::find($heroeIndividual->id);
                    
                    $count3 = 0;
                        foreach($aux->equipamientos()->get() as $equipo){
                            //dd($carta->nombre_carta);
                            $equipamientos[$count3] = $equipo->nombre_equipamiento_dc;
                            $count3++;
                        }
                    }

                    // IDS del héroe
                    //$idHeroeParty = 

                    // 4- Guardar junta toda la información
                    $data[$count][0] = $nombresHeroes;
                    $data[$count][1] = $nombresClases;
                    $data[$count][2] = $habilidades;
                    $data[$count][3] = $equipamientos;
                    $data[$count][4] = $heroeIndividual->id_heroe_dc;
                    $data[$count][5] = $heroeIndividual->id;

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

    public function listarPartidasDescentUsuario($id_usuario){

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

    public function adminListarTodasLasPartidasDescent(){

        $respuesta = new Respuesta();
        //$comprobaciones = new Comprobaciones();

        try{  
            $partidaList = PartidasJuegos::where('nombre_imagen', 'Descent')->get();    
            $respuesta->setRespuestaExito($respuesta, $partidaList);

            
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }


    public function listarMisionesDescent(){

        $respuesta = new Respuesta();

        try{  
                $misionList = MisionDc::select('nombre_mision_dc')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);

                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->nombre_mision_dc;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarCartasDescent(){

        $respuesta = new Respuesta();

        try{  
                $misionList = CartaOverlordDc::select('nombre_carta')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->nombre_carta;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarHeroesDescent(){

        $respuesta = new Respuesta();

        try{  
                $misionList = HeroeDc::select('nombre_heroe_dc')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->nombre_heroe_dc;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarEquipoDescent(){

        $respuesta = new Respuesta();

        try{  
                $misionList = EquipamientoDc::select('nombre_equipamiento_dc')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->nombre_equipamiento_dc;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarHabilidadesDescent(){

        $respuesta = new Respuesta();

        try{  
                $misionList = ClaseDc::select('nombre_clase_dc')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->nombre_clase_dc;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
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

    

    public function actualizarTodosHeroePartidaDescent(Request $request, $id_partida_descent){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        $dataNueva = []; 

        // id = ID de la party 
        // id_heroe_dc = es el tipo de heroe diferente,
        
        // 1- Obtener datos generales de la partida
        $partidaDescent = Descent::find($id_partida_descent);

        // Usuario con sesión iniciada posee la partida
        if ($comprobaciones->checkActualUserIsUser() 
        && ($comprobaciones->partidaPerteneceUsuarioActual($partidaDescent->id_partida_general))){
            
            // -- Obtener heroes seleccionados que existen en la partida (todosLosHeroesActualesId)
            $todosLosHeroesActualesSeleccionados = PartyDc::select('id')->where('id_partida_dc' , $partidaDescent->id)->get();
           //dd($todosLosHeroesActualesSeleccionados);
            

            $count4 = 0;
            $todosLosHeroesActualesId = [];
            foreach($todosLosHeroesActualesSeleccionados as $heroeActual){
                $todosLosHeroesActualesId[$count4] = $heroeActual["id"];
                $count4++;
            }
            //dd($todosLosHeroesActualesId);


            $todosLosHeroesUpdateId = [];
            $todosLosHeroesUpdateIdDc = [];

            // -- Obtener heroes seleccionados de la actualizacion (todosLosHeroesUpdateIdDc)
            // -- Y el id para saber a que Party pertenece cada uno (todosLosHeroesUpdateId)
            $count2 = 0;
            while($request[$count2] != null){

                $id_heroe = $request[$count2]["id_heroe_dc"];
                $todosLosHeroesUpdateIdDc[$count2] = $id_heroe;

                $id_heroe = $request[$count2]["id"];
                $todosLosHeroesUpdateId[$count2] = $id_heroe;
                $count2++;
            }

            //dd($todosLosHeroesUpdateIdDc);
            //dd($todosLosHeroesUpdateId);


            /*
            foreach($request as $heroeActual){
                $id_heroe = $heroeActual["id_heroe"];
                dd($heroeActual);
                $todosLosHeroesId[$count2] = $id_heroe;
               
                $count2++;
            }*/
            


            // Buscar los ID de los heroes actuales en los actualizados.
            // Si no se encuentra uno significa que se han borrado, y por tanto lo debemos borrar.
            $count3 = 0;
            foreach($todosLosHeroesActualesId as $heroeActualId){
                
                if(!in_array($heroeActualId, $todosLosHeroesUpdateId)) {

                    $id_party_heroe_actual = PartyDc::select('id')->where('id_partida_dc' , $partidaDescent->id)->where('id' , $heroeActualId)->first();
                    //dd($id_party_heroe_actual);
                    $this->eliminarHeroePartidaDescent($id_party_heroe_actual["id"]);
                    
                }
                $count3++;
            }
            
     
            $todosLosHeroes = [];
            $count = 0;
            /*
            foreach($request->heroes as $heroeActual){
                $id_heroe = $heroeActual["id_heroe"];
                
                $todosLosHeroes[$count] = $this->actualizarHeroePartidaDescent($heroeActual, $id_heroe, $id_partida_descent);
               
                $count++;
            }
*/


            // -- Los que no han sido borrados existen, y por tanto se van a actualizar
            while($request[$count] != null){
       
                $todosLosHeroesId[$count] = $this->actualizarHeroePartidaDescent($request[$count], $id_partida_descent);
                $count++;
            }

            $respuesta->setRespuestaExito($respuesta, "Actualización Exitosa");
        } else {

            $respuesta->setRespuestaErrorSinPermisos($respuesta);
            return response()->json($respuesta);
        }
        return response()->json($respuesta);
    }

    public function actualizarHeroePartidaDescent($heroeActual, $id_partida_descent){
        
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        $dataNueva = []; 
        $id_heroe =  $heroeActual["id"];
        
        // 1- Obtener datos generales de la partida
       
                    //dd($heroeActual);
                    //dd($id_heroe);
                    //dd($id_partida_descent);

        // 2- Obtener al heroe de la partida actualizada
            
            $heroe = PartyDc::where('id_partida_dc' , $id_partida_descent)->where('id' , $id_heroe)->first();
            
            //dd($heroe);
        
        // 3- Obtener información del héroe
        // habilidades_clase [], equipo_heroe [], id_heroe_dc
        $heroe->id_heroe_dc = $heroeActual["id_heroe_dc"];
        
        
        $habilidadesHeroe = PartyDc::find($heroe->id);
        $equipoHeroe = PartyDc::find($heroe->id);
        $habilidadesNuevas = [];
        $equipoNuevo = [];
        // Habilidades del heroe
        
        
        if(empty($heroeActual["habilidades_clase"])){

            $habilidadesHeroe->clases()->detach();

        } else{
            
            $count2 = 0;
            foreach($heroeActual["habilidades_clase"] as $habilidadNueva){
                
                $aux = ClaseDc::select('id')->where('nombre_clase_dc' , $habilidadNueva)->first();
                
                $habilidadesNuevas[$count2] = $aux->id;
                $count2++;
                
            }
            
            $habilidadesHeroe->clases()->sync($habilidadesNuevas);
        }

        // Equipo del heroe
        

        if(empty($heroeActual["equipo_heroe"])){

            $equipoHeroe->equipamientos()->detach();

        } else{
            
            $count2 = 0;
            foreach($heroeActual["equipo_heroe"] as $equipo){
                $aux = EquipamientoDc::select('id')->where('nombre_equipamiento_dc' , $equipo)->first();
                $equipoNuevo[$count2] = $aux->id;
                $count2++;
            }
            
            $equipoHeroe->equipamientos()->sync($equipoNuevo);
        }
        
        
        $heroe->save();
        // 4- Mostrar toda la información
        $dataNueva[0] = $heroe->id;
        $dataNueva[1] = $habilidadesHeroe->clases()->allRelatedIds();
        $dataNueva[2] = $equipoHeroe->equipamientos()->allRelatedIds();
        //dd($dataNueva);
        return $dataNueva;
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
    
                //$respuesta->setRespuestaExito($respuesta, $partidaDescent);
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }

        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        //return response()->json($respuesta);
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
