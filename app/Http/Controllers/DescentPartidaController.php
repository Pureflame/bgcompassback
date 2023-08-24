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
use App\Models\Carta_Overlord_Descent;
use App\Models\CartaOverlordDc;
use App\Models\Clase_Descent;
use App\Models\Clase_Party_Descent;
use App\Models\ClaseDc;
use App\Models\ClasePartyDc;
use App\Models\Descent;
use App\Models\Equipamiento_Descent;
use App\Models\Equipamiento_Party_Descent;
use App\Models\Heroe_Descent;
use App\Models\HeroeDc;
use App\Models\Mazo_Overlord_Descent;
use App\Models\Mision_Descent;
use App\Models\MisionDc;
use App\Models\Overlord_Descent;
use App\Models\Party_Descent;
use App\Models\PartyDc;
use League\CommonMark\Extension\Table\Table;

class DescentPartidaController extends Controller
{
    ///////////////////////////////////////////////////////////////////////
    //////////////                CREATE                     //////////////
    ///////////////////////////////////////////////////////////////////////

    public function crearPartidaDescent(Request $request){

        $request->validate([
            'nombre_partida_dc' => ['required','string','min:2','max:40','regex:/^[a-zA-Z ]+$/'],
        ]);

        $respuesta = new Respuesta();

        try{

            $partida = new Descent();

            $partida->oro_dc = $request->nombre_partida_dc;
            $partida->oro_dc = 0;

            $partida->save(); 
            $respuesta->setRespuestaExito($respuesta, $partida);

        } catch(\Exception $e){
            //dd(DB::table('administradores')->select('administradores.dni_admin')->where('dni_admin', $request->dni_admin)->first());
            $respuesta->setRespuestaErrorGeneral($respuesta);
        }

        return response()->json($respuesta);
    }


    ///////////////////////////////////////////////////////////////////////
    //////////////                 READ                      //////////////
    ///////////////////////////////////////////////////////////////////////


    public function verGeneralPartidaDescent($id_partida){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        $data = [];
        
        try{  
            // Usuario con sesión iniciada posee la partida
            if ($comprobaciones->checkActualUserIsUser() 
            && ($comprobaciones->partidaDescentPerteneceUsuarioActual($id_partida))){
        

                // 1- Obtener datos generales de la partida
                $partida = Descent::find($id_partida);
                    //dd($partida);


                // 2- Obtener cartas del Overlord


                if(!$partida->cartas()->first()){

                    $CartasOverlord[0] = "Sin cartas";

                } else{
                    $CartasOverlord = [];
                    $count = 0;
                    foreach($partida->cartas()->get() as $carta){
                        //dd($carta->nombre_carta);
                        $CartasOverlord[$count] = $carta->nombre_carta;
                        $count++;
                    }
                }

                    //dd($CartasOverlord);

                // 3- Obtener misión actual
                $misionActual = MisionDc::select('nombre_mision_dc')->where('id' , $partida->id_mision_dc)->first();
                    //dd($misionActual);




                // 5- Guardar junta toda la información
                $data[0] = $partida->nombre_partida;
                $data[1] = $partida->oro;
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

    public function verHeroePartidaDescent($id_partida){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        $data = [];

        try{  
            // Usuario con sesión iniciada posee la partida
            if ($comprobaciones->checkActualUserIsUser() 
            && ($comprobaciones->partidaDescentPerteneceUsuarioActual($id_partida))){
        
                
                // 1- Obtener datos generales de la partida
                $partida = Descent::find($id_partida);
                    //dd($partida);


                // 2- Obtener parties de la partida
                $arrayParties = PartyDc::where('id_partida_dc' , $partida->id)->get();
                    //dd($arrayParties);

                // 3- Obtener información de cada héroe
                $count = 0;
                foreach($arrayParties as $heroeIndividual){
                    $nombresHeroes = [];
                    $habilidades = [];
                    $equipamientos = [];
/*
                    if($heroeIndividual->id == 3){
                        $aux = PartyDc::where('id', $heroeIndividual->id)->first();

                        
                        if(!$aux->equipamientos()->first()){
                            dd("hi");
                        }
                        dd("there");
                    }
*/
                    // Nombre del héroe

                    $aux = HeroeDc::find($heroeIndividual->id_heroe_dc);
                    //$aux = HeroeDc::where('id', $heroeIndividual->id_heroe_dc)->first();
                    $nombresHeroes[$count] = $aux->nombre_heroe_dc;
                        //dd($nombresHeroes);


                    // Habilidades de la Clase y Nombre de la clase

                    $aux = PartyDc::find($heroeIndividual->id);
                    //$aux = PartyDc::where('id', $heroeIndividual->id)->first();   
                    //dd($aux);

                    if(!$aux->clases()->first()){

                        $habilidades[0] = "Ninguna";
                        $tituloClase = "Sin Clase";

                    } else{

                        $count2 = 0;
                        foreach($aux->clases()->get() as $clase){
                            //dd($carta->nombre_carta);
                            $habilidades[$count2] = $clase->nombre_clase_dc;
                            $count2++;
                        }
    
                        // 
                        $auxtituloClase = ClaseDc::select('titulo_clase_dc')->where('nombre_clase_dc' , $habilidades[0])->first();
                        $tituloClase = $auxtituloClase->titulo_clase_dc;
                    }
                    
                    // Equipamiento del héroe
                    if(!$aux->clases()->first()){

                        $equipamientos[0] = "Sin equipo";

                    } else{
                    
                    $aux = PartyDc::find($heroeIndividual->id);
                    //$aux = PartyDc::where('id', $heroeIndividual->id)->first();
                    
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
        
                
                $correo = $comprobaciones->obtenerCorreoUsuario($id_usuario);
                $partidaList = Descent::where('correo_usuario' , $correo);
                
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


    public function actualizarGeneralPartidaDescent(Request $request, $id_partida){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        $dataNueva = [];

        /*
        $dataNueva[0] = $request->nombre_partida_dc;
        $dataNueva[1] = $request->oro_dc;
        $dataNueva[2] = $request->nombre_mision_dc;
        $dataNueva[3] = $request->CartasOverlord;
        */
        

        try{  
            // Usuario con sesión iniciada posee la partida
            if ($comprobaciones->checkActualUserIsUser() 
            && ($comprobaciones->partidaDescentPerteneceUsuarioActual($id_partida))){
        
                
                // 1- Obtener datos generales de la partida
                $partida = Descent::find($id_partida);
                
                // 2- Seleccionar la misión actual
                $nuevamision = MisionDc::select('id')->where('nombre_mision_dc' , $request->nombre_mision_dc)->first();
                
                $partida->nombre_partida = $request->nombre_partida;
                $partida->oro = $request->oro;
                
                $partida->id_mision_dc = $nuevamision->id;
                //dd($partida);
                $partida->save();
                    //dd($partida);


                // 3- Actualizar mazo de cartas del Overlord.

                

                //    Borramos primero para evitar que queden descartes.
                //Mazo_Overlord_Descent::where('id_overlord_dc' , $partida->id_overlord_dc)->delete();

                $count = 0;
                $cartasOverlord = [];
                
                foreach($request->cartasOverlord as $carta){
                    
                    $aux = CartaOverlordDc::select('id')->where('nombre_carta' , $carta)->first();
                        //dd($aux);
                    $cartasOverlord[$count] = $aux->id;
                        //dd($cartasOverlord[$count]);

                    //$mazo->update();

                    $count++;
                }
                //dd($cartasOverlord);
                $partida->cartas()->sync($cartasOverlord);



                // 4- Guardar junta toda la información
                $dataNueva[0] = $partida->nombre_partida;
                $dataNueva[1] = $partida->oro;
                $dataNueva[2] = $partida->id_mision_dc;
                $dataNueva[3] = $partida->correo_usuario;
                $dataNueva[4] = $partida->cartas()->allRelatedIds();
                    //dd($dataNueva);

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



    ///////////////////////////////////////////////////////////////////////
    //////////////                DELETE                     //////////////
    ///////////////////////////////////////////////////////////////////////

    public function eliminarPartidaDescent($id_partida){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        
        try{
            
            if($comprobaciones->checkActualUserIsUser()){
                
                $partidaDescent = Descent::findOrFail($id_partida);

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
