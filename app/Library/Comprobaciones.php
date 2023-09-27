<?php

namespace App\Library;

use Illuminate\Support\Facades\DB;
use App\Models\Usuario;

class Comprobaciones {

    // Comprueba que el usuario actual logueado sea un administrador
    public function checkActualUserIsAdmin(){
        
        if(DB::table('administradores')->select('administradores.dni_admin')->where('dni_admin', auth()->user()->dni_admin)->first() != null){
            return true;
        }
        else{
            return false;
        }
    }

    public function checkIsAdmin($correo){
        
        if(DB::table('administradores')->select('administradores.correo_admin')->where('correo_admin', $correo)->first() != null){
            return true;
        }
        else{
            return false;
        }
    }


    // Comprueba que el usuario actual logueado sea un usuario
    public function checkActualUserIsUser(){
    
        if(DB::table('usuarios')->select('usuarios.correo_usuario')->where('correo_usuario', auth()->user()->correo_usuario)->first() != null){
            return true;
        }
        else{
            return false;
        }
    }

    public function checkIsUser($correo){
    
        if(DB::table('usuarios')->select('usuarios.correo_usuario')->where('correo_usuario', $correo)->first() != null){
            return true;
        }
        else{
            return false;
        }
    }

    ///////////////////////////////////////////////////////////////////////
    //////////////                   DNI                     //////////////
    ///////////////////////////////////////////////////////////////////////

    // Comprueba que el administrador no estea repetido
    public function checkDNIAdmin($requestDNI){
        
        if(DB::table('administradores')->select('administradores.dni_admin')->where('dni_admin', $requestDNI)->first() != null){
            return true;
        }
        else{
            return false;
        }
    }

    ///////////////////////////////////////////////////////////////////////
    //////////////                 CORREO                    //////////////
    ///////////////////////////////////////////////////////////////////////

    // Comprueba que el correo del administrador exista
    public function checkCorreoAdmin($requestEmail){

        if(DB::table('administradores')->select('administradores.correo_admin')->where('correo_admin', $requestEmail)->first() != null){
            return true;
        }
        else{
            return false;
        }
    }

    // Comprueba que el correo del usuario exista
    public function checkCorreoUsuario($requestEmail){

        if(DB::table('usuarios')->select('usuarios.correo_usuario')->where('correo_usuario', $requestEmail)->first() != null){
            return true;
        }
        else{
            return false;
        }
    }

    // Comprueba el usuario al cual pertenece el id sea el usuario actual conectado
    public function checkIDUsuarioActual($id){

        if(DB::table('usuarios')->select('usuarios.correo_usuario')->where('id', $id)->where('correo_usuario', auth()->user()->correo_usuario)->first() != null){
            return true;
        }
        else{
            return false;
        }
    }

    function obtenerCorreoUsuario($id){

        $usuario = Usuario::findOrFail($id);
        return $usuario->correo_usuario;
    }


    ///////////////////////////////////////////////////////////////////////
    //////////////                 DESCENT                   //////////////
    ///////////////////////////////////////////////////////////////////////


function partidaPerteneceUsuarioActual($id_partida_general){
    if(DB::table('partidas_juegos')->select('id')->where('id', $id_partida_general)->where('correo_usuario', auth()->user()->correo_usuario)->first() != null){
        return true;
    }
    else{
        return false;
    }
}


}