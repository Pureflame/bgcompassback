<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Usuario;

use Illuminate\Http\Request;

use App\Library\Respuesta;
use App\Library\Comprobaciones;
use App\Models\ConversacionGloomhaven;
use App\Models\MensajeGloomhaven;


class GloomhavenForoController extends Controller
{
    ///////////////////////////////////////////////////////////////////////
    //////////////                CREATE                     //////////////
    ///////////////////////////////////////////////////////////////////////

    // Crear discusion ($id_current_user)
    public function crearDiscusionForoGloomhaven(Request $request){

        $request->validate([
            'titulo_conversacion_gh' => ['required','string','min:6','max:255','regex:/^(?=.*[0-9a-zA-Z ]).*$/'],
        ]);
        
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
// try{} catch(\Exception $e){}
        $conversacion = new ConversacionGloomhaven();

        $conversacion->titulo_conversacion_gh = $request->titulo_conversacion_gh;
        $conversacion->correo_usuario = auth()->user()->correo_usuario;

        $conversacion->save();
        $respuesta->setRespuestaExito($respuesta, $conversacion);


        return response()->json($respuesta);
    }




    // Crear mensaje ($id_conversacion)
    public function crearMensajeForoGloomhaven(Request $request, $id_conversacion){
        $request->validate([
            'texto_mensaje_gh' => ['required','string','min:2','max:255','regex:/^(?=.*[0-9a-zA-Z@#¿?¡!*_\-$%^&+=]).*$/'],
        ]);
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
// try{} catch(\Exception $e){}
        $mensaje = new MensajeGloomhaven();

        $mensaje->texto_mensaje_gh = $request->texto_mensaje_gh;
        $mensaje->id_conversacion_gh = $id_conversacion;
        $mensaje->correo_usuario = auth()->user()->correo_usuario;

        $mensaje->save();
        $respuesta->setRespuestaExito($respuesta, $mensaje);


        return response()->json($respuesta);
    }





    ///////////////////////////////////////////////////////////////////////
    //////////////                READ_ALL                   //////////////
    ///////////////////////////////////////////////////////////////////////

    // Leer todas las discusiones del usuario actual ($id_current_user)
    public function listarDiscusionesUsuarioForoGloomhaven(Request $request){
        $respuesta = new Respuesta();
        $discusiones = ConversacionGloomhaven::where('correo_usuario', auth()->user()->correo_usuario)->get();
        $usuario = Usuario::select('nombre_usuario')->where('correo_usuario', auth()->user()->correo_usuario)->first();

        try{

            $nombresDiscusiones = [];
            $count = 0;
            foreach($discusiones as $discusion){
                $nombresDiscusiones[$count][0] = $discusion->id;
                $nombresDiscusiones[$count][1] = $discusion->titulo_conversacion_gh;
                $nombresDiscusiones[$count][2] = $usuario->nombre_usuario;
                $nombresDiscusiones[$count][3] = "gloomhaven";
                $count++;
            }
            $respuesta->setRespuestaExito($respuesta, $nombresDiscusiones);

            
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        
        return response()->json($respuesta);
    }



    // Leer todas las discusiones de Gloomhaven
    public function listarDiscusionesForoGloomhaven(Request $request){
        // NO NECESITA ESTAR LOGUEADO
        $respuesta = new Respuesta();
        $discusiones = ConversacionGloomhaven::all();
        
        try{

            $nombresDiscusiones = [];
            $count = 0;
            foreach($discusiones as $discusion){

                $usuario = Usuario::select('nombre_usuario')->where('correo_usuario', $discusion->correo_usuario)->first();
                
                $nombresDiscusiones[$count][0] = $discusion->id;
                $nombresDiscusiones[$count][1] = $discusion->titulo_conversacion_gh;
                $nombresDiscusiones[$count][2] = $usuario->nombre_usuario;
                $nombresDiscusiones[$count][3] = "gloomhaven";
                $count++;
            }
            $respuesta->setRespuestaExito($respuesta, $nombresDiscusiones);
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        
        return response()->json($respuesta);
    }




    // Leer todos los mensajes escritos por el usuario actual ($id_current_user)
    public function listarMensajesUsuarioForoGloomhaven(Request $request){
        $respuesta = new Respuesta();
        $mensajes = MensajeGloomhaven::where('correo_usuario', auth()->user()->correo_usuario)->get();
        try{
            $textoMensajes = [];
            $count = 0;
            foreach($mensajes as $mensaje){
                $textoMensajes[$count] = $mensaje->texto_mensaje_gh;
                $count++;
            }
            $respuesta->setRespuestaExito($respuesta, $textoMensajes);
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        
        return response()->json($respuesta);
    }



    // Leer todos los mensajes de una discusión ($id_conversacion)
    public function listarMensajesDiscusionForoGloomhaven(Request $request, $id_conversacion){
        $respuesta = new Respuesta();
        $mensajes = MensajeGloomhaven::where('id_conversacion_gh', $id_conversacion)->get();
        try{
            $textoMensajes = [];
            $count = 0;
            foreach($mensajes as $mensaje){

                $usuario = Usuario::select('nombre_usuario')->where('correo_usuario', $mensaje->correo_usuario)->first();
                
                $textoMensajes[$count][0] = $mensaje->id;
                $textoMensajes[$count][1] = $mensaje->texto_mensaje_gh;
                $textoMensajes[$count][2] = $usuario->nombre_usuario;
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
    public function eliminarDiscusionForoGloomhaven(Request $request, $id_conversacion){
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        if($comprobaciones->checkActualUserIsAdmin()){
                
            $discusion = ConversacionGloomhaven::findorfail($id_conversacion);
            $discusion->delete();
            $respuesta->setRespuestaExito($respuesta, $discusion);

        } else {
            $respuesta->setRespuestaErrorSinPermisos($respuesta);
            return response()->json($respuesta);
        }
        return response()->json($respuesta);

    }

    // Admin - Borrar mensaje ($id_mensaje)
    public function eliminarMensajeForoGloomhaven(Request $request, $id_mensaje){
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        if($comprobaciones->checkActualUserIsAdmin()){
                
            $mensaje = MensajeGloomhaven::findorfail($id_mensaje);
            $mensaje->delete();
            $respuesta->setRespuestaExito($respuesta, $mensaje);

        } else {
            $respuesta->setRespuestaErrorSinPermisos($respuesta);
            return response()->json($respuesta);
        }
        return response()->json($respuesta);
    }




}

