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

class UserController extends Controller
{

    ///////////////////////////////////////////////////////////////////////
    //////////////                CREATE                     //////////////
    ///////////////////////////////////////////////////////////////////////

    // Registrar administradores, encargados o usuarios.
    // Se harían en una vista diferente al usuario, y son creados por un administrador.
    // Los usuarios usuarios crearían sus propios usuarios.
    public function registrarUsuario(Request $request){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        try{

            // Comprobar que no estea repetido el administrador a ingresar en ninguna tabla. 
            if($request->tipo_usuario === "admin"
                && !$comprobaciones->checkDNIAdmin($request->dni_admin)
                && !$comprobaciones->checkCorreoAdmin($request->correo_admin)
                && !$comprobaciones->checkCorreoUsuario($request->correo_admin)){

                // Si el usuario a ingresar es un admin, comprobar que el usuario logueado es un admin.
                if(!$comprobaciones->checkActualUserIsAdmin()){
                    $respuesta->setRespuestaErrorSinPermisos($respuesta);
                    return response()->json($respuesta);
                } else{
                    $register = new Administrador();
                    $this->adminPrepararDatos($register, $request);
                }

            // Comprobar que no estea repetido el usuario a ingresar en ninguna tabla.
            } else if ($request->tipo_usuario === "usuario"
                && !$comprobaciones->checkCorreoAdmin($request->correo_usuario)
                && !$comprobaciones->checkCorreoUsuario($request->correo_usuario)){

                $register = new Usuario();

                $register->nombre_usuario = $request->nombre_usuario;
                $register->contrasenha_usuario = Hash::make($request->contrasenha_usuario);
                $register->correo_usuario = $request->correo_usuario;
            }


            // Guardamos fecha y hora de creación
            //$register->created_at = Carbon::now()->format('Y-m-d H:i:s');
     
            // Registramos el usuario
            $register->save(); 
            $respuesta->setRespuestaExito($respuesta, $register);
            
        } catch(\Exception $e){
            //dd(DB::table('administradores')->select('administradores.dni_admin')->where('dni_admin', $request->dni_admin)->first());
            $respuesta->setRespuestaErrorDuplicidad($respuesta);
        }

        return response()->json($respuesta);
    }




    ///////////////////////////////////////////////////////////////////////
    //////////////                  READ                     //////////////
    ///////////////////////////////////////////////////////////////////////

    public function verDatosAdmin($id){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        $admin = new Administrador();

        try{
            // Solo se puede hacer si es un administrador
            if($comprobaciones->checkActualUserIsAdmin()){
                
                $admin = Administrador::findOrFail($id);
                $respuesta->setRespuestaExito($respuesta, $admin);

            } else {
                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }

        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }

    public function verDatosUsuario($id){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        $usuario = new Usuario();

        try{  
            // Solo se puede hacer si es un administrador, o el usuario al cual pertenece el id (es decir, el propio usuario que mira sus datos)
            if ($comprobaciones->checkActualUserIsAdmin()
            || ($comprobaciones->checkIDUsuarioActual($id))){
        
                //dd($id);
                $usuario = Usuario::findOrFail($id);
                $respuesta->setRespuestaExito($respuesta, $usuario);
                
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


    ///////////////////////////////////////////////////////////////////////
    //////////////                UPDATE                     //////////////
    ///////////////////////////////////////////////////////////////////////

    public function actualizarDatosAdmin(Request $request, $id){

        $request->validate([
            'dni_admin' => ['required','string','regex:/(^[0-9]{8}[A-Z]{1}$)/'],
            'nombre_admin' => ['required','string','min:2','max:20','regex:/^[a-zA-Z ]+$/'],
            'apellidos_admin' => ['required','string','min:2','max:40','regex:/^[a-zA-Z ]+$/'],
            'contrasenha_admin' => ['required','string','min:10','max:255','regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#¿?¡!*_\-$%^&+=]).*$/'],
            'correo_admin' => ['required','string','email:rfc,dns'],
            'telefono_admin' => ['nullable','string','regex:/^[0-9+]{9,12}$/'],
        ]);

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        
        try{

            if($comprobaciones->checkActualUserIsAdmin()){
                
                $admin = Administrador::findOrFail($id);
                $this->adminPrepararDatos($admin, $request);

    
                // Guardamos fecha y hora de actualización

                //$admin->updated_at = Carbon::now()->format('Y-m-d H:i:s');
    
                if($comprobaciones->checkCorreoAdmin($admin->correo_admin)  
                || $comprobaciones->checkCorreoUsuario($admin->correo_admin)){

                    $respuesta->setRespuestaErrorCorreo($respuesta);
                    return response()->json($respuesta);

                } else if($comprobaciones->checkDNIAdmin($admin->dni_admin)){

                    $respuesta->setRespuestaErrorDNI($respuesta);
                    return response()->json($respuesta);

                } else{
                    $admin->save();
                    $respuesta->setRespuestaExito($respuesta, $admin);
                }

            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }

        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }



    public function actualizarDatosUsuario(Request $request, $id){
        
        $request->validate([
            'nombre_usuario' => ['required','string','min:2','max:20','regex:/^[a-zA-Z ]+$/'],
            'contrasenha_usuario' => ['required','string','min:10','max:255','regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#¿?¡!*_\-$%^&+=]).*$/'],
        ]);

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        try{

            $usuario = Usuario::findOrFail($id);

            $usuario->nombre_usuario = $request->nombre_usuario;
            $usuario->contrasenha_usuario = Hash::make($request->contrasenha_usuario);

            $usuario->save();
            $respuesta->setRespuestaExito($respuesta, $usuario);
           

        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }
    
    ///////////////////////////////////////////////////////////////////////
    //////////////                DELETE                     //////////////
    ///////////////////////////////////////////////////////////////////////



    public function destroyAdmin($id){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        
        try{
            
            if($comprobaciones->checkActualUserIsAdmin()){
                
                $admin = Administrador::findOrFail($id);
                $admin->delete();
    
                $respuesta->setRespuestaExito($respuesta, $admin);
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }

        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }


    public function destroyUsuario($id){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        
        try{

            if($comprobaciones->checkActualUserIsAdmin()){
                
                $usuario = Usuario::findOrFail($id);
                $usuario->delete();
    
                $respuesta->setRespuestaExito($respuesta, $usuario);
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
    //////////////                CREATE                     //////////////
    ///////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////
    //////////////                 READ                      //////////////
    ///////////////////////////////////////////////////////////////////////


    ///////////////////////////////////////////////////////////////////////
    //////////////                READ_ALL                   //////////////
    ///////////////////////////////////////////////////////////////////////


    ///////////////////////////////////////////////////////////////////////
    //////////////                UPDATE                     //////////////
    ///////////////////////////////////////////////////////////////////////


    ///////////////////////////////////////////////////////////////////////
    //////////////                DELETE                     //////////////
    ///////////////////////////////////////////////////////////////////////






    function adminPrepararDatos($admin, $request){
        $admin->dni_admin = $request->dni_admin;
        $admin->nombre_admin = $request->nombre_admin;
        $admin->apellidos_admin = $request->apellidos_admin;
        $admin->contrasenha_admin = Hash::make($request->contrasenha_admin);
        $admin->correo_admin = $request->correo_admin;
        $admin->telefono_admin = $request->telefono_admin;
    }
}
