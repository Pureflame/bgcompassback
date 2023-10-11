<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Library\Respuesta;
use App\Library\Comprobaciones;
use App\Models\EquipamientoGh;
use App\Models\Gloomhaven;
use App\Models\HabilidadGh;
use App\Models\HeroeGh;
use App\Models\LogroGlobalGh;
use App\Models\LogroGrupoGh;
use App\Models\LogrosPartyGh;
use App\Models\MisionGh;
use App\Models\MisionPersonalGh;
use App\Models\PartidasJuegos;
use App\Models\PartyGh;
use App\Models\PericiaGh;
use Mockery\Undefined;

class GloomhavenPartidaController extends Controller
{
    ///////////////////////////////////////////////////////////////////////
    //////////////                CREATE                     //////////////
    ///////////////////////////////////////////////////////////////////////


    public function crearPartidaGloomhaven(Request $request){

        $request->validate([
            'nombre_partida' => ['required','string','min:2','max:40','regex:/^[a-zA-Z ]+$/'],
        ]);

        $respuesta = new Respuesta();

        // nombre_partida, correo_usuario, oro, id_mision_dc
        try{
            $partida = new PartidasJuegos();
            $partida->nombre_partida = $request->nombre_partida;
            $partida->correo_usuario = auth()->user()->correo_usuario;
            $partida->nombre_imagen = "Gloomhaven";
            $partida->save();

            $gloomhaven = new Gloomhaven();
            $gloomhaven->prosperidad_ciudad_partida_gh = $request->prosperidad_ciudad_partida_gh;
            $gloomhaven->id_partida_general = $partida->id;
            $gloomhaven->id_mision_gh = $request->id_mision_gh;
            $gloomhaven->save();
             
             
            $this->crearHeroePartidaGloomhaven($gloomhaven->id);

            $respuesta->setRespuestaExito($respuesta, $partida);

        } catch(\Exception $e){
            //dd(DB::table('administradores')->select('administradores.dni_admin')->where('dni_admin', $request->dni_admin)->first());
        //    $respuesta->setRespuestaErrorGeneral($respuesta);
        }

        return response()->json($respuesta);
    }



    public function crearHeroePartidaGloomhaven($id_partida_gloomhaven){

        $respuesta = new Respuesta();

        try{

            $partidaGloomhaven = Gloomhaven::find($id_partida_gloomhaven);
            $maximodeHeroes = PartyGh::where('id_partida_gh' , $partidaGloomhaven->id)->get();
            $reputacionHeroe = 0;

            
            $party = new PartyGh();

            // La reputacion pertenece al grupo de la party
            // Todos los miembros del mismo grupo tienen la misma reputacion
            // Buscamos a un miembros del grupo 1 y le ponemos su misma reputacion
            $reputacionGrupo = PartyGh::select('reputacion_party_gh')->where('grupo_party_gh' , 1)->first();
            if($reputacionGrupo != null){
                $reputacionHeroe = $reputacionGrupo;
            } else{
                $reputacionHeroe = 0;
            }
            
            $party->id_partida_gh = $partidaGloomhaven->id;
            
            $party->grupo_party_gh = 1;
            $party->id_heroe_gh = 1;
            
            $party->nombre_party_gh = "nombre";
            $party->experiencia_party_gh = 0;
            
            $party->reputacion_party_gh = $reputacionHeroe->reputacion_party_gh;
            $party->oro_party_gh = 0;
            
            $party->marcas_party_gh = 0;
            $party->id_mision_personal_gh = 1;
            //dd($party);
            $party->save(); 
            
            $respuesta->setRespuestaExito($respuesta, $party);
            


        } catch(\Exception $e){
            $respuesta->setRespuestaErrorGeneral($respuesta);
        }

        return response()->json($respuesta);
    }





    ///////////////////////////////////////////////////////////////////////
    //////////////                 READ                      //////////////
    ///////////////////////////////////////////////////////////////////////

    public function verGeneralPartidaGloomhaven($id_partida_gloomhaven){

        // Información de la tabla Gloomhaven, Mision y Logros Globales

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        $data = [];

        // 1- Obtener datos generales de la partida
        $partidaGloomhaven = Gloomhaven::find($id_partida_gloomhaven);
        //dd($partidaGloomhaven->logrosGlobales()->first());
        try{  
            // Usuario con sesión iniciada posee la partida o es un administrador
            if (
                ($comprobaciones->checkActualUserIsUser() && ($comprobaciones->partidaPerteneceUsuarioActual($partidaGloomhaven->id_partida_general))) ||
                $comprobaciones->checkActualUserIsAdmin()
                ){
                    
                // 2- Obtener logros globales de la partida
                if(!$partidaGloomhaven->logrosGlobales()->first()){

                    $logrosGlobalesPartida[0] = "";
                    
                } else{
                    
                    $logrosGlobalesPartida = [];
                    $count = 0;
                    foreach($partidaGloomhaven->logrosGlobales()->get() as $logro){
                        //dd($logro->titulo_logro_global_gh);
                        $logrosGlobalesPartida[$count] = $logro->titulo_logro_global_gh;
                        $count++;
                    }
                }
                
                    //dd($logrosGlobalesPartida);

                // 3- Obtener misión actual y nombre de la partida
                $misionActual = MisionGh::select('nombre_mision_gh')->where('id' , $partidaGloomhaven->id_mision_gh)->first();
                $partida = PartidasJuegos::select('nombre_partida')->where('id', $partidaGloomhaven->id_partida_general)->first();


                // 5- Guardar junta toda la información
                $data[0] = $partida->nombre_partida;
                $data[1] = $partidaGloomhaven->prosperidad_ciudad_partida_gh;
                $data[2] = $misionActual->nombre_mision_gh;
                $data[3] = $logrosGlobalesPartida;
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
    public function verHeroePartidaGloomhaven($id_partida_gloomhaven){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        $data = [];

        // 1- Obtener datos generales de la partida
        $partidaGloomhaven = Gloomhaven::find($id_partida_gloomhaven);

        //try{  
            // Usuario con sesión iniciada posee la partida
            if (
                ($comprobaciones->checkActualUserIsUser() && ($comprobaciones->partidaPerteneceUsuarioActual($partidaGloomhaven->id_partida_general))) ||
                $comprobaciones->checkActualUserIsAdmin()
                ){
                

                    

                // 2- Obtener parties de la partida
                $arrayParties = PartyGh::where('id_partida_gh' , $partidaGloomhaven->id)->get();
                

                // 3- Obtener información de cada héroe
                $count = 0;
                foreach($arrayParties as $heroeIndividual){
                    $nombreHeroe = [];
                    $nombreClase = [];
                    $habilidades = [];
                    $equipamientos = [];
                    $pericias = [];

                    // Nombre del héroe
                    //$aux = PartyGh::find($heroeIndividual->id);
                    //$nombreHeroe = $aux->nombre_party_gh;

                    // Habilidades de la Clase y Nombre de la clase
                    $aux = PartyGh::find($heroeIndividual->id);
                    
                    if(!$aux->habilidades()->first()){

                        $habilidades[0] = "";
                        
                    } else{

                        $count2 = 0;
                        foreach($aux->habilidades()->get() as $clase){
                            
                            $habilidades[$count2] = $clase->nombre_habilidad_gh;
                            $count2++;
                        }
    
                        // Nombre de la clase (quizá no es necesario pero lo dejo por si a caso)
                        $auxtituloClase = HabilidadGh::select('clase_habilidad_gh')->where('nombre_habilidad_gh' , $habilidades[0])->first();
                        $nombreClaseSegunHabilidades = $auxtituloClase->clase_habilidad_gh;

                        $nombreClase = HeroeGh::select('clase_heroe_gh')->where('clase_heroe_gh', $nombreClaseSegunHabilidades)->first();
                    }
                    
                    // Equipamiento del héroe
                    if(!$aux->equipamientos()->first()){
                        
                        $equipamientos[0] = "";

                    } else{
                    
                    $aux = PartyGh::find($heroeIndividual->id);
                    
                    $count3 = 0;
                        foreach($aux->equipamientos()->get() as $equipo){
                            //dd($carta->nombre_carta);
                            $equipamientos[$count3] = $equipo->nombre_equipamiento_gh;
                            $count3++;
                        }
                    }
                    
                    // Pericias del héroe
                    if(!$aux->pericias()->first()){

                        $pericias[0] = "";

                    } else{
                    
                    $aux = PartyGh::find($heroeIndividual->id);
                    
                    $count4 = 0;
                        foreach($aux->pericias()->get() as $pericia){
                            //dd($carta->nombre_carta);
                            $pericias[$count4] = $pericia->descripcion_pericia_gh;
                            $count4++;
                        }
                    }

                    // Misión personal del héroe
                    $auxM = MisionPersonalGh::find($heroeIndividual->id_mision_personal_gh);
                    $misionPersonalHeroe = $auxM->nombre_mision_personal_gh;

                    // IDS del héroe
                    //$idHeroeParty = 

                    // 4- Guardar junta toda la información
                    $data[$count][0] = $heroeIndividual->id;
                    $data[$count][1] = $heroeIndividual->grupo_party_gh;
                    $data[$count][2] = $heroeIndividual->id_heroe_gh;
                    $data[$count][3] = $heroeIndividual->nombre_party_gh;
                    $data[$count][4] = $nombreClase->clase_heroe_gh;
                    $data[$count][5] = $heroeIndividual->experiencia_party_gh;
                    $data[$count][6] = $heroeIndividual->reputacion_party_gh;
                    $data[$count][7] = $heroeIndividual->oro_party_gh;
                    $data[$count][8] = $heroeIndividual->marcas_party_gh;
                    $data[$count][9] = $misionPersonalHeroe;
                    $data[$count][10] = $habilidades;
                    $data[$count][11] = $equipamientos;
                    $data[$count][12] = $pericias;

                    $count++;
                }

                //dd($data);
                
                $respuesta->setRespuestaExito($respuesta, $data);
                
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }
            
        //}catch(\Exception $e){
        //    $respuesta->setRespuestaErrorElemento($respuesta);
        //}

        return response()->json($respuesta);
    }


    ///////////////////////////////////////////////////////////////////////
    //////////////                READ_ALL                   //////////////
    ///////////////////////////////////////////////////////////////////////

    public function listarPartidasGloomhavenUsuario($id_usuario){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        try{  
            // Solo se puede hacer si es el usuario al cual pertenece el id
            if ($comprobaciones->checkIDUsuarioActual($id_usuario)){
        
                //dd("df");
                $correo = $comprobaciones->obtenerCorreoUsuario($id_usuario);
                //dd($correo);
                $partidaList = PartidasJuegos::where('correo_usuario' , $correo)->where('nombre_imagen', 'Gloomhaven')->get();
                
                
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

    public function adminListarTodasLasPartidasGloomhaven(){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        try{  
            if ($comprobaciones->checkActualUserIsAdmin()){
            $partidaList = PartidasJuegos::where('nombre_imagen', 'Gloomhaven')->get();    
            $respuesta->setRespuestaExito($respuesta, $partidaList);
            }else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }
            
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        return response()->json($respuesta);
    }

    public function listarMisionesGloomhaven(){

        $respuesta = new Respuesta();

        try{  
                $misionList = MisionGh::select('nombre_mision_gh')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->nombre_mision_gh;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarLogrosGlobalesGloomhaven(){

        $respuesta = new Respuesta();

        try{  
                $misionList = LogroGlobalGh::select('titulo_logro_global_gh')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->titulo_logro_global_gh;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarMisionesPersonalesGloomhaven(){

        $respuesta = new Respuesta();

        try{  
                $misionList = MisionPersonalGh::select('nombre_mision_personal_gh')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->nombre_mision_personal_gh;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarLogrosGrupoGloomhaven(){

        $respuesta = new Respuesta();

        try{  
                $misionList = LogroGrupoGh::select('titulo_logro_grupo_gh')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->titulo_logro_grupo_gh;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarPericiasGloomhaven(){

        $respuesta = new Respuesta();

        try{  
                $misionList = PericiaGh::select('descripcion_pericia_gh')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->descripcion_pericia_gh;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarHeroesGloomhaven(){

        $respuesta = new Respuesta();

        try{  
                $misionList = HeroeGh::select('clase_heroe_gh')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->clase_heroe_gh;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarHabilidadesGloomhaven(){

        $respuesta = new Respuesta();

        try{  
                $misionList = HabilidadGh::select('nombre_habilidad_gh')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->nombre_habilidad_gh;
                    $count3++;
                }
                $respuesta->setRespuestaExito($respuesta, $misionListaFinal);
                
        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }
        return response()->json($respuesta);
    }

    public function listarEquipoGloomhaven(){

        $respuesta = new Respuesta();

        try{  
                $misionList = EquipamientoGh::select('nombre_equipamiento_gh')->get();    
                $respuesta->setRespuestaExito($respuesta, $misionList);
                
                $count3 = 0;
                foreach($misionList as $lista){
                    //dd($carta->nombre_carta);
                    $misionListaFinal[$count3] = $lista->nombre_equipamiento_gh;
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

    public function actualizarGeneralPartidaGloomhaven(Request $request, $id_partida_gloomhaven){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        $dataNueva = [];  

        // 1- Obtener datos generales de la partida
        $partidaGloomhaven = Gloomhaven::find($id_partida_gloomhaven);
   
        try{  
            // Usuario con sesión iniciada posee la partida
            if ($comprobaciones->checkActualUserIsUser() 
            && ($comprobaciones->partidaPerteneceUsuarioActual($partidaGloomhaven->id_partida_general))){
        
                
                // 2- Actualizar la partida
                $partida = PartidasJuegos::find($partidaGloomhaven->id_partida_general);
                $nuevamision = MisionGh::select('id')->where('nombre_mision_gh' , $request->nombre_mision_gh)->first();
                
                
                $partidaGloomhaven->prosperidad_ciudad_partida_gh = $request->prosperidad_ciudad_partida_gh;
                $partidaGloomhaven->id_mision_gh = $nuevamision->id;
                //$gloomhaven->id_partida_general = $partida->id;
                $partidaGloomhaven->save();

                $partida->nombre_partida = $request->nombre_partida;
                $partida->save();


                // 3- Actualizar logros globales de la partida.
                $count = 0;
                $logrosGlobales = [];
                
                foreach($request->logros_globales as $logro){
                    
                    $aux = LogroGlobalGh::select('id')->where('titulo_logro_global_gh' , $logro)->first();
                    $logrosGlobales[$count] = $aux->id;
                    $count++;
                }

                $partidaGloomhaven->logrosGlobales()->sync($logrosGlobales);

                

                // 4- Mostrar toda la información
                $dataNueva[0] = $partida->nombre_partida;
                $dataNueva[1] = $partidaGloomhaven->prosperidad_ciudad_partida_gh;
                $dataNueva[2] = $partidaGloomhaven->id_mision_gh;
                $dataNueva[3] = $partida->correo_usuario;
                $dataNueva[4] = $partidaGloomhaven->logrosGlobales()->allRelatedIds();

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



    // $request["heroes"][????] -> la info general del heroe
    // $request["grupos"][????] -> id, reputacion y logros
    public function actualizarTodosHeroePartidaGloomhaven(Request $request, $id_partida_gloomhaven){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        $dataNueva = []; 

        // id = ID de la party 
        // id_heroe_gh = es el tipo de heroe diferente,
        
        // 1- Obtener datos generales de la partida
        $partidaGloomhaven = Gloomhaven::find($id_partida_gloomhaven);

        // Usuario con sesión iniciada posee la partida
        if ($comprobaciones->checkActualUserIsUser() 
        && ($comprobaciones->partidaPerteneceUsuarioActual($partidaGloomhaven->id_partida_general))){
            
            // -- Obtener heroes seleccionados que existen en la partida (todosLosHeroesActualesId)
            $todosLosHeroesActualesSeleccionados = PartyGh::select('id')->where('id_partida_gh' , $partidaGloomhaven->id)->get();
            //dd($todosLosHeroesActualesSeleccionados);
            

            $count4 = 0;
            $todosLosHeroesActualesId = [];
            foreach($todosLosHeroesActualesSeleccionados as $heroeActual){
                $todosLosHeroesActualesId[$count4] = $heroeActual["id"];
                $count4++;
            }
            //dd($todosLosHeroesActualesId);
    

            $todosLosHeroesUpdateId = [];
            $todosLosHeroesUpdateIdGh = [];
            $todosLosHeroesUpdateGrupo = [];

            // -- Obtener heroes seleccionados de la actualizacion (todosLosHeroesUpdateIdGh)
            // -- Y el id para saber a que Party pertenece cada uno (todosLosHeroesUpdateId)
            // -- Y el grupo para saber a que grupo pertenece cada uno (todosLosHeroesUpdateGrupo)
            $count2 = 0;
            while(count($request["heroes"]) > $count2){
                
                $heroeActual = $request["heroes"][$count2];
                
                $aux = $heroeActual["id_heroe_gh"];
                $todosLosHeroesUpdateIdGh[$count2] = $aux;
                
                $aux = $heroeActual["id"];
                $todosLosHeroesUpdateId[$count2] = $aux;
                
                $aux = $heroeActual["grupo_party_gh"];
                $todosLosHeroesUpdateGrupo[$count2] = $aux;
                
                $count2++;
            }
            
                    
    
            //dd($todosLosHeroesUpdateIdGh);
            //dd($todosLosHeroesUpdateId);
            //dd($todosLosHeroesUpdateGrupo);

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

                    $id_party_heroe_actual = PartyGh::select('id')->where('id_partida_gh' , $partidaGloomhaven->id)->where('id' , $heroeActualId)->first();
                    //dd($id_party_heroe_actual);
                    $this->eliminarHeroePartidaGloomhaven($id_party_heroe_actual["id"]);
                    
                }
                $count3++;
            }
            
            // -- Los que no han sido borrados existen, y por tanto se van a actualizar
            $count = 0;
            while(count($request["heroes"]) > $count){
       
                //$todosLosHeroesId[$count] = $this->actualizarHeroePartidaDescent($request["heroes"][$count], $id_partida_gloomhaven);
                $this->actualizarHeroePartidaDescent($request["heroes"][$count], $id_partida_gloomhaven);
                
                $count++;
            }
            //dd("actualiza pre-grupos");

            //Actualizar la reputación y logros del grupo de cada héroe
            $count5 = 0;
            while(count($request["grupos"]) > $count5){

                $grupoActual = $request["grupos"][$count5];

                
                //Hacerlo en cada heroe
                $count6 = 0;
                while(count($request["heroes"]) > $count6){

                    $heroeActual = $request["heroes"][$count6];
                    
                    // Actualizar los datos del héroe actual que pertenezca al grupo actual
                    if(
                        PartyGh::where('grupo_party_gh' , $grupoActual["id_grupo"])->where('id' , $heroeActual["id"])->first() != null
                    ){
                        
                        $heroe = PartyGh::where('id_partida_gh' , $id_partida_gloomhaven)->where('id' , $heroeActual["id"])->first();

                        // Reputacion
                        $heroe->reputacion_party_gh = $grupoActual["reputacion_grupo"];
                        
                        // Logros del grupo
                        $logrosGrupo = [];
                        $count = 0;
                        //dd($grupoActual["logros_grupo"]);
                        foreach($grupoActual["logros_grupo"] as $logro){
                            
                            $aux = LogroGrupoGh::select('id')->where('titulo_logro_grupo_gh' , $logro)->first();
                            
                            $logrosGrupo[$count] = $aux->id;
                            $count++;
                            //dd($logrosGrupo);
                        }
                        //dd($count);
                        $logrosHeroe = PartyGh::find($heroe->id);
                        $logrosHeroe->logrosGrupo()->sync($logrosGrupo);
                        //dd("g2");
                        $heroe->save();
                    }
                    
                    
                    //dd($count5);
                    $count6++;
                }
                
                //dd("g2");
                $count5++;
            }



            $respuesta->setRespuestaExito($respuesta, "Actualización Exitosa");
        } else {

            $respuesta->setRespuestaErrorSinPermisos($respuesta);
            return response()->json($respuesta);
        }
        return response()->json($respuesta);
    }



    public function actualizarHeroePartidaDescent($heroeActual, $id_partida_gloomhaven){
        
        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();

        $dataNueva = []; 
        $id_heroe =  $heroeActual["id"];
        
        // 1- Obtener datos generales de la partida
       
                    //dd($heroeActual);
                    //dd($id_heroe);
                    //dd($id_partida_gloomhaven);

        // 2- Obtener al heroe de la partida actualizada
            
            $heroe = PartyGh::where('id_partida_gh' , $id_partida_gloomhaven)->where('id' , $id_heroe)->first();
            
            //dd($heroe);
        
        // 3- Obtener información del héroe
        // habilidades_clase [], equipo_heroe [], id_heroe_dc
        
        $heroe->grupo_party_gh = $heroeActual["grupo_party_gh"];
        $heroe->id_heroe_gh = $heroeActual["id_heroe_gh"];
        $heroe->id_heroe_gh = $heroeActual["id_heroe_gh"];
        $heroe->nombre_party_gh = $heroeActual["nombre_party_gh"];
        $heroe->experiencia_party_gh = $heroeActual["experiencia_party_gh"];
        //$heroe->reputacion_party_gh = $heroeActual["reputacion_party_gh"];
        $heroe->oro_party_gh = $heroeActual["oro_party_gh"];
        $heroe->marcas_party_gh = $heroeActual["marcas_party_gh"];
        $heroe->id_mision_personal_gh = $heroeActual["id_mision_personal_gh"];

        // LA REPUTACION DEPENDE DEL GRUPO, REVISAD
        


        
        
        $habilidadesHeroe = PartyGh::find($heroe->id);
        $equipoHeroe = PartyGh::find($heroe->id);
        $periciasHeroe = PartyGh::find($heroe->id);
        $habilidadesNuevas = [];
        $equipoNuevo = [];
        $periciasNuevas = [];
        
        // Habilidades del heroe
        if(empty($heroeActual["habilidades_nuevas"])){

            $habilidadesHeroe->habilidades()->detach();

        } else{
            
            $count2 = 0;
            foreach($heroeActual["habilidades_nuevas"] as $habilidadNueva){
                
                $aux = HabilidadGh::select('id')->where('nombre_habilidad_gh' , $habilidadNueva)->first();
                
                $habilidadesNuevas[$count2] = $aux->id;
                $count2++;
                
            }
            
            $habilidadesHeroe->habilidades()->sync($habilidadesNuevas);
        }
        

        // Equipo del heroe
        if(empty($heroeActual["equipo_nuevo"])){

            $equipoHeroe->equipamientos()->detach();

        } else{
           
            $count2 = 0;
            
            foreach($heroeActual["equipo_nuevo"] as $equipo){
                $aux = EquipamientoGh::select('id')->where('nombre_equipamiento_gh' , $equipo)->first();
                //dd($aux->id);
                $equipoNuevo[$count2] = $aux->id;
                
                $count2++;
            }
            
            $equipoHeroe->equipamientos()->sync($equipoNuevo);
        }
        

        // Pericias del heroe
        if(empty($heroeActual["pericias_nuevas"])){

            $periciasHeroe->pericias()->detach();

        } else{
            
            $count2 = 0;
            foreach($heroeActual["pericias_nuevas"] as $periciaNueva){
                
                $aux = PericiaGh::select('id')->where('descripcion_pericia_gh' , $periciaNueva)->first();
                
                $periciasNuevas[$count2] = $aux->id;
                $count2++;
                
            }
            
            $habilidadesHeroe->pericias()->sync($periciasNuevas);
        }
        
        //dd("hi");
        $heroe->save();
        
        // 4- Mostrar toda la información
        // Hay más que estas, pero lo dejaré asi
        $dataNueva[0] = $heroe->id;
        $dataNueva[1] = $habilidadesHeroe->habilidades()->allRelatedIds();
        $dataNueva[2] = $equipoHeroe->equipamientos()->allRelatedIds();
        $dataNueva[3] = $periciasHeroe->pericias()->allRelatedIds();
        //dd($dataNueva);
        return $dataNueva;
    }



    ///////////////////////////////////////////////////////////////////////
    //////////////                DELETE                     //////////////
    ///////////////////////////////////////////////////////////////////////


    public function eliminarPartidaGloomhaven($id_partida_gloomhaven){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        
        try{
            
            if($comprobaciones->checkActualUserIsUser()){
                
                $partidaGloomhaven = Gloomhaven::findOrFail($id_partida_gloomhaven);
                $partida = PartidasJuegos::findOrFail($partidaGloomhaven->id_partida_general);

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

    public function eliminarHeroePartidaGloomhaven($id_party){

        $respuesta = new Respuesta();
        $comprobaciones = new Comprobaciones();
        
        try{
            
            if($comprobaciones->checkActualUserIsUser()){
                
                $partidaGloomhaven = PartyGh::findOrFail($id_party);
                
                $partidaGloomhaven->delete();
    
                $respuesta->setRespuestaExito($respuesta, $partidaGloomhaven);
            } else {

                $respuesta->setRespuestaErrorSinPermisos($respuesta);
                return response()->json($respuesta);
            }

        }catch(\Exception $e){
            $respuesta->setRespuestaErrorElemento($respuesta);
        }

        //return response()->json($respuesta);
    }


}
