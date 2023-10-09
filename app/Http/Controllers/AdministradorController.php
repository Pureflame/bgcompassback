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
use App\Models\ConversacionDescent;
use App\Models\Descent;
use App\Models\EquipamientoDc;
use App\Models\HeroeDc;
use App\Models\MisionDc;
use App\Models\PartidasJuegos;
use App\Models\PartyDc;

class AdministradorController extends Controller
{
    public function adminListarTodasLasPartidas(){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        
        try{  
            // Solo se puede hacer si es el usuario al cual pertenece el id
            if ($comprobaciones->checkActualUserIsAdmin()){
        
                $partidaList = PartidasJuegos::all();
                //dd($partidaList);
                
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

    public function adminListarTodasLasDiscusiones(){
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        $count = 0;

        try{  
            // Solo se puede hacer si es el usuario al cual pertenece el id
            if ($comprobaciones->checkActualUserIsAdmin()){
                $todasLasDiscusiones = [];
                // DESCENT
                $discusionesDescent = ConversacionDescent::all();
                
                //dd($discusionesDescent);

                //dd($discusionesDescent[0]["id"]);
                //dd($discusionesDescent[0]["titulo_conversacion_dc"]);
                //dd($discusionesDescent[0]["correo_usuario"]);

                
                foreach($discusionesDescent as $discusionIndividual){
                    //dd($discusionIndividual);

                    $usuario = Usuario::select('nombre_usuario')->where('correo_usuario', $discusionIndividual['correo_usuario'])->first();

                    $todasLasDiscusiones[$count][0] = $discusionIndividual["id"];
                    $todasLasDiscusiones[$count][1] = $discusionIndividual["titulo_conversacion_dc"];
                    $todasLasDiscusiones[$count][2] = $usuario->nombre_usuario;
                    $todasLasDiscusiones[$count][3] = "descent";
                    
                    $count++;
                }


                //dd($todasLasDiscusiones);
                
                
                // GLOOMHAVEN
/*
                $discusionesGloomhaven = ConversacionGloomhaven::all();

                foreach($discusionesGloomhaven as $discusionIndividual){
                    //dd($discusionIndividual);
                    $todasLasDiscusiones[$count]["id_gh"] = $discusionIndividual["id"];
                    $todasLasDiscusiones[$count]["titulo_conversacion"] = $discusionIndividual["titulo_conversacion_gh"];
                    $todasLasDiscusiones[$count]["correo_usuario"] = $discusionIndividual["correo_usuario"];
                    $todasLasDiscusiones[$count]["nombre_juego"] = "gloomhaven";
                    $count++;
                }
*/
                $respuesta->setRespuestaExito($respuesta, $todasLasDiscusiones);
                
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }
            
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }

    public function adminListarTodasLasDiscusionesDescent(){
            // lo hice arriba
    }

    public function adminListarTodasLasDiscusionesGloomhaven(){
            // lo hice arriba
    }
}
