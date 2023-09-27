<?php

namespace App\Library;

class Respuesta {

    const EXITO = 200;
    const TXT_EXITO = 'Éxito';
    const TXT_EXITO_LOGIN_ADMIN = 'administrador';
    const TXT_EXITO_LOGIN_USER = 'usuario';

    const ERROR_CODIGO = 300;
    const TXT_ERROR_CODIGO = 'Error en código';

    const ERROR_ELEMENTO = 404;
    const TXT_ERROR_ELEMENTO = 'Error, elemento no encontrado';

    const ERROR_ELEMENTO_DUPLICADO = 400;
    const TXT_ERROR_ELEMENTO_DUPLICADO = 'Error, elemento duplicado';

    const ERROR_GENERAL = 400;
    const TXT_ERROR_GENERAL = 'Ha ocurrido un error';

    public $estadoCodigo;
    public $mensaje;
    public $data;

    // Ponemos error de serie para evitar falsos positivos
    function __construct(){

        $this->estadoCodigo = self::ERROR_CODIGO;
        $this->mensaje = self::TXT_ERROR_CODIGO;
        $this->data = '';
    }

    ///////////////////////////////////////////////////////////////////////
    //////////////                  GETS                     //////////////
    ///////////////////////////////////////////////////////////////////////

    public function getEstadoCodigo($estadoCodigo){
        return $this->estadoCodigo;
    }

    public function getMensaje($mensaje){
        return $this->mensaje;
    }

    public function getDatos($data){
        return $this->data;
    }

    ///////////////////////////////////////////////////////////////////////
    //////////////                  SETS                     //////////////
    ///////////////////////////////////////////////////////////////////////

    public function setEstadoCodigo($estadoCodigo) : void{
        $this->estadoCodigo = $estadoCodigo;
    }

    public function setMensaje($mensaje) : void{
        $this->mensaje = $mensaje;
    }

    public function setDatos($data) : void{
        $this->data = $data;
    }

    ///////////////////////////////////////////////////////////////////////
    //////////////                 ACCIONES                  //////////////
    ///////////////////////////////////////////////////////////////////////

    public function setRespuestaExito($respuesta, $data) : void{
        $respuesta->setDatos($data);
        $respuesta->setEstadoCodigo(self::EXITO);
        $respuesta->setMensaje(self::TXT_EXITO);
    }

    public function setLoginExitoAdmin($respuesta, $data) : void{
        $respuesta->setDatos($data);
        $respuesta->setEstadoCodigo(self::EXITO);
        $respuesta->setMensaje(self::TXT_EXITO_LOGIN_ADMIN);
    }

    public function setLoginExitoUser($respuesta, $data) : void{
        $respuesta->setDatos($data);
        $respuesta->setEstadoCodigo(self::EXITO);
        $respuesta->setMensaje(self::TXT_EXITO_LOGIN_USER);
    }

    public function setRespuestaErrorCodigo($respuesta) : void{
        $respuesta->setEstadoCodigo(self::ERROR_CODIGO);
        $respuesta->setMensaje(self::TXT_ERROR_CODIGO);
    }

    public function setRespuestaErrorSinPermisos($respuesta) : void{
        $respuesta->setDatos("No tienes permiso para realizar esta acción");
        $this->setRespuestaErrorCodigo($respuesta);
    }

    public function setRespuestaErrorCorreo($respuesta) : void{
        $respuesta->setDatos("Correo invalido");
        $this->setRespuestaErrorCodigo($respuesta);
    }

    public function setRespuestaErrorDNI($respuesta) : void{
        $respuesta->setDatos("DNI invalido");
        $this->setRespuestaErrorCodigo($respuesta);
    }

    public function setRespuestaErrorElemento($respuesta) : void{
        $respuesta->setEstadoCodigo(self::ERROR_ELEMENTO);
        $respuesta->setMensaje(self::TXT_ERROR_ELEMENTO);
    }

    public function setRespuestaErrorDuplicidad($respuesta) : void{
        $respuesta->setEstadoCodigo(self::ERROR_ELEMENTO_DUPLICADO);
        $respuesta->setMensaje(self::TXT_ERROR_ELEMENTO_DUPLICADO);
    }

    public function setRespuestaErrorGeneral($respuesta) : void{
        $respuesta->setEstadoCodigo(self::ERROR_GENERAL);
        $respuesta->setMensaje(self::TXT_ERROR_GENERAL);
    }




    public function setRespuestaMaximoHeroesAlcanzado($respuesta) : void{
        $respuesta->setEstadoCodigo(self::ERROR_GENERAL);
        $respuesta->setMensaje("Maximo de héroes alcanzado, no se pueden crear más");
    }

}