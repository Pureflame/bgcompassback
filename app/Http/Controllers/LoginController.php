<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

use App\Library\Respuesta;
use App\Library\Comprobaciones;


class LoginController extends Controller
{
    protected $usuario;

    public function login(Request $request){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        $credenciales = array();
        $data = [];  

        if($comprobaciones->checkCorreoAdmin($request->email)){
            
            // Comprobar credenciales administrador
            $credenciales = $this->credencialesAdmin($request->email, $request->password);
            Auth::guard('administrador')->attempt($credenciales);

            // Obtener el usuario que está realizando el login
            $user = Administrador::where('correo_admin', $request->email)->first();
            $userId = Administrador::select('id')->where('correo_admin', $request->email)->first();
            $token = $user->createToken($request->email)->plainTextToken;

            $data[0] = $token;
            $data[1] = $userId['id'];

            $respuesta->setLoginExitoAdmin($respuesta, $data);
            //return response(["status"=>200, "Result"=>"LOGIN: Te has logueado correctamente","token"=>$token]);
            return response()->json($respuesta);
            //return response()->json(["token"=>$token],["Resultado"=>$respuesta]);

        } else if($comprobaciones->checkCorreoUsuario($request->email)){
                      
            // Comprobar credenciales usuario
            $credenciales = $this->credencialesUsuario($request->email, $request->password);
            Auth::guard('usuario')->attempt($credenciales);

            // Obtener el usuario que está realizando el login
            $user = Usuario::where('correo_usuario', $request->email)->first();
            $userId = Usuario::select('id')->where('correo_usuario', $request->email)->first();
            $token = $user->createToken($request->email)->plainTextToken;



            $data[0] = $token;
            $data[1] = $userId['id'];


            $respuesta->setLoginExitoUser($respuesta, $data);
            //return response(["status"=>200, "Result"=>"LOGIN: Te has logueado correctamente","token"=>$token]);
            return response()->json($respuesta);

        } else{
            $respuesta->setRespuestaErrorElemento($respuesta);
            return response()->json($respuesta);
        }
    }

    // Cerrar sesión. 
    // Eliminamos el token de acceso del usuario actual.
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response(["status"=>200, "Result"=>"LOGOUT: Cierre de sesión"], Response::HTTP_OK);
    }


    ///////////////////////////////////////////////////////////////////////
    //////////////                 ACCIONES                  //////////////
    ///////////////////////////////////////////////////////////////////////


    function credencialesAdmin($email, $password){
        return array(
            'correo_admin' => $email,
            'contrasenha_admin' => $password
        );
    }

    function credencialesUsuario($email, $password){
        return array(
            'correo_usuario' => $email,
            'contrasenha_usuario' => $password
        );
    }
}
