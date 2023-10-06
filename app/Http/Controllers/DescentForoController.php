<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Usuario;

use App\Models\ConversacionDescent;
use Illuminate\Http\Request;

use App\Library\Respuesta;
use App\Library\Comprobaciones;
use App\Models\MensajeDescent;

class DescentForoController extends Controller
{

    ///////////////////////////////////////////////////////////////////////
    //////////////                CREATE                     //////////////
    ///////////////////////////////////////////////////////////////////////

    // Crear discusion ($id_current_user)
    public function crearDiscusionForoDescent(Request $request){

        $request->validate([
            'titulo_conversacion_dc' => ['required','string','min:6','max:255','regex:/^(?=.*[0-9a-zA-Z ]).*$/'],
        ]);
        
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
// try{} catch(\Exception $e){}
        $conversacion = new ConversacionDescent();

        $conversacion->titulo_conversacion_dc = $request->titulo_conversacion_dc;
        $conversacion->correo_usuario = auth()->user()->correo_usuario;

        $conversacion->save();
        $respuesta->setRespuestaExito($respuesta, $conversacion);


        return response()->json($respuesta);
    }


    // Crear mensaje ($id_conversacion)
    public function crearMensajeForoDescent(Request $request, $id_conversacion){
        $request->validate([
            'texto_mensaje_dc' => ['required','string','min:2','max:255','regex:/^(?=.*[0-9a-zA-Z@#¿?¡!*_\-$%^&+=]).*$/'],
        ]);
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
// try{} catch(\Exception $e){}
        $mensaje = new MensajeDescent();

        $mensaje->texto_mensaje_dc = $request->texto_mensaje_dc;
        $mensaje->id_conversacion_dc = $id_conversacion;
        $mensaje->correo_usuario = auth()->user()->correo_usuario;

        $mensaje->save();
        $respuesta->setRespuestaExito($respuesta, $mensaje);


        return response()->json($respuesta);
    }





    

    ///////////////////////////////////////////////////////////////////////
    //////////////                READ_ALL                   //////////////
    ///////////////////////////////////////////////////////////////////////

    // Leer todas las discusiones del usuario actual ($id_current_user)
    public function listarDiscusionesUsuarioForoDescent(Request $request){
        $respuesta = new Respuesta();
        $discusiones = ConversacionDescent::where('correo_usuario', auth()->user()->correo_usuario)->get();
        
        try{

            $nombresDiscusiones = [];
            $count = 0;
            foreach($discusiones as $discusion){
                $nombresDiscusiones[$count] = $discusion->titulo_conversacion_dc;
                $count++;
            }
            $respuesta->setRespuestaExito($respuesta, $nombresDiscusiones);



            
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        
        return response()->json($respuesta);
    }

    // Leer todas las discusiones de Descent
    public function listarDiscusionesForoDescent(Request $request){
        // NO NECESITA ESTAR LOGUEADO
        $respuesta = new Respuesta();
        $discusiones = ConversacionDescent::all();
        
        try{


            $nombresDiscusiones = [];
            $count = 0;
            foreach($discusiones as $discusion){

                $usuario = Usuario::select('nombre_usuario')->where('correo_usuario', $discusion->correo_usuario)->first();
                
                $nombresDiscusiones[$count][0] = $discusion->titulo_conversacion_dc;
                $nombresDiscusiones[$count][1] = $usuario->nombre_usuario;
                $count++;
            }
            $respuesta->setRespuestaExito($respuesta, $nombresDiscusiones);
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        
        return response()->json($respuesta);
    }

    // Leer todos los mensajes escritos por el usuario actual ($id_current_user)
    public function listarMensajesUsuarioForoDescent(Request $request){
        $respuesta = new Respuesta();
        $mensajes = MensajeDescent::where('correo_usuario', auth()->user()->correo_usuario)->get();
        try{
            $textoMensajes = [];
            $count = 0;
            foreach($mensajes as $mensaje){
                $textoMensajes[$count] = $mensaje->texto_mensaje_dc;
                $count++;
            }
            $respuesta->setRespuestaExito($respuesta, $textoMensajes);
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        
        return response()->json($respuesta);
    }

    // Leer todos los mensajes de una discusión ($id_conversacion)
    public function listarMensajesDiscusionForoDescent(Request $request, $id_conversacion){
        $respuesta = new Respuesta();
        $mensajes = MensajeDescent::where('id_conversacion_dc', $id_conversacion)->get();
        try{
            $textoMensajes = [];
            $count = 0;
            foreach($mensajes as $mensaje){

                $usuario = Usuario::select('nombre_usuario')->where('correo_usuario', $mensaje->correo_usuario)->first();

                $textoMensajes[$count][0] = $mensaje->texto_mensaje_dc;
                $textoMensajes[$count][1] = $usuario->nombre_usuario;
                $count++;
            }
            $respuesta->setRespuestaExito($respuesta, $textoMensajes);
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        
        return response()->json($respuesta);
    }
















    ///////////////////////////////////////////////////////////////////////
    //////////////                DELETE                     //////////////
    ///////////////////////////////////////////////////////////////////////

    // Admin - Borrar discusión ($id_conversacion)
    public function eliminarDiscusionForoDescent(Request $request, $id_conversacion){
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        if($comprobaciones->checkActualUserIsAdmin()){
                
            $discusion = ConversacionDescent::findorfail($id_conversacion);
            $discusion->delete();
            $respuesta->setRespuestaExito($respuesta, $discusion);

        } else {
            $respuesta->setRespuestaErrorSinPermisos($respuesta);
            return response()->json($respuesta);
        }
        return response()->json($respuesta);

    }

    // Admin - Borrar mensaje ($id_mensaje)
    public function eliminarMensajeForoDescent(Request $request, $id_mensaje){
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        if($comprobaciones->checkActualUserIsAdmin()){
                
            $mensaje = MensajeDescent::findorfail($id_mensaje);
            $mensaje->delete();
            $respuesta->setRespuestaExito($respuesta, $mensaje);

        } else {
            $respuesta->setRespuestaErrorSinPermisos($respuesta);
            return response()->json($respuesta);
        }
        return response()->json($respuesta);
    }

}
