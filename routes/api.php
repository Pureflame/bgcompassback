<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DescentPartidaController;
use App\Http\Controllers\DescentForoController;
use App\Http\Controllers\GloomhavenPartidaController;
use App\Http\Controllers\GloomhavenForoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

///////////////////////////////////////////////////////////////////////
//////////////                LOGIN                      //////////////
///////////////////////////////////////////////////////////////////////

// Usuario / Admin - Iniciar Sesión
Route::post('login', [LoginController::class, 'login'])->middleware('login.validate')->name('usuarios.login');

// Usuario / Admin - Cerrar Sesión
Route::group( ['middleware' => ['auth:sanctum']], function(){
    Route::post('logout', [LoginController::class, 'logout'])->name('usuarios.logout');
} );




///////////////////////////////////////////////////////////////////////
//////////////               USER                        //////////////
///////////////////////////////////////////////////////////////////////

// Crear un Admin/Usuario
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('usuario-registro/administrador', [UserController::class, 'registrarUsuario'])->middleware('registerAdmin.validate')->name('usuarios.registro.admin');
});
Route::post('usuario-registro/usuario', [UserController::class, 'registrarUsuario'])->middleware('registerUsuario.validate')->name('usuarios.registro.usuario');

// ¿Ver todos los Usuarios?
//Route::get('administrador/list', [UserController::class, 'listarAdministradores'])->name('admins.list');
//Route::get('usuarios/list', [UserController::class, 'listarUsuarios'])->name('usuarios.list');

// ¿Actualizar Usuarios?

// ¿Eliminar Usuarios?
Route::delete('usuario-borrar/administrador/{id}', [UserController::class, 'deleteAdmin'])->name('admin.delete');
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('usuario-borrar/usuario/{id}', [UserController::class, 'deleteUsuario'])->name('usuarios.delete');
});
// Ver Usuario actual según su correo
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('usuario-actual/ver', [UserController::class, 'verDatosUsuarioActual'])->name('usuarios.usuario.actual');
});
// Usuario / Admin Perfil - Ver Datos de Usuario
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('usuario-perfil/administrador/ver/{id}', [UserController::class, 'verDatosAdmin'])->name('usuarios.perfil.admin.datos.ver');
    Route::get('usuario-perfil/usuario/ver/{id}', [UserController::class, 'verDatosUsuario'])->name('usuarios.perfil.usuario.datos.ver');
});

// Usuario Perfil - Actualizar Datos de Usuario
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::put('usuario-perfil/administrador/actualizar/{id}', [UserController::class, 'actualizarDatosAdmin'])->name('usuarios.perfil.admin.datos.actualizar');
    Route::put('usuario-perfil/usuario/actualizar/{id}', [UserController::class, 'actualizarDatosUsuario'])->name('usuarios.perfil.usuario.datos.actualizar');
});


///////////////////////////////////////////////////////////////////////
//////////////           JUEGOS DE MESA                  //////////////
///////////////////////////////////////////////////////////////////////

// Menú Principal de Campañas y Foros - Listar Juegos de Mesa 
//Route::get('menu/partidas', [JuegosController::class, 'listarJuegos'])->middleware('')->name('menu.principal.partidas');
//Route::get('menu/foros', [JuegosController::class, 'listarForos'])->middleware('')->name('menu.principal.foros');

// Usuario Perfil - Listar Partidas creadas de todos los juegos de un usuario
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('usuario-perfil/usuario/partidas/{id}', [UserController::class, 'listarPartidasUsuario'])->middleware('')->name('usuarios.perfil.usuario.listar.partidas');
});

// Usuario Perfil - Listar Discusiones del Foro de todos los juegos de un usuario
//Route::group(['middleware' => ['auth:sanctum']], function(){
//    Route::get('usuario-perfil/usuario/discusiones/{id}', [UserController::class, 'listarDiscusionesUsuario'])->middleware('')->name('usuarios.perfil.usuario.listar.discusiones');
//});

// Admin - Ver todas las Partidas creadas por un Usuario de todos los juegos
//Route::group(['middleware' => ['auth:sanctum']], function(){
//    Route::get('admin/partidas-usuario/{id}', [UserController::class, 'adminVerPartidasUsuario'])->middleware('')->name('admin.ver.partidas.usuario');
//});

// Admin Perfil - Ver todas las Partidas creadas de todos los juegos
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('admin/partidas-juegos', [AdministradorController::class, 'adminListarTodasLasPartidas'])->name('admin.listar.partidas');
});

// Admin Perfil - Ver todas las Discusiones creadas de todos los juegos
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('admin/discusiones-juegos', [AdministradorController::class, 'adminListarTodasLasDiscusiones'])->name('admin.listar.discusiones');
});

///////////////////////////////////////////////////////////////////////
//////////////                  OTROS                    //////////////
///////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////
//////////////           DESCENT - PARTIDA               //////////////
///////////////////////////////////////////////////////////////////////

// Usuario - Crear Partida de Descent
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('descent/partida', [DescentPartidaController::class, 'crearPartidaDescent'])->name('descent.partida.crear');
});

// Admin - Listar todas las Partidas de Descent
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('descent/partidas', [DescentPartidaController::class, 'adminListarTodasLasPartidasDescent'])->name('descent.admin.listar.partidas');
});

// Usuario - Listar Partidas de Descent de un usuario
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('descent/partidas/{id}', [DescentPartidaController::class, 'listarPartidasDescentUsuario'])->name('descent.partida.listar.partidas');
});

// Usuario - Eliminar Partida de Descent (y todo lo que contiene)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('descent/partida/{id}', [DescentPartidaController::class, 'eliminarPartidaDescent'])->name('descent.partida.eliminar');
});


// Usuario - Ver Datos de Partida de Descent (Mision actual, Mazo de Cartas de Overlord y Oro actual del grupo)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('descent/{idpartida}/general', [DescentPartidaController::class, 'verGeneralPartidaDescent'])->name('descent.partida.ver.general');
});

// Usuario - Añadir/Actualizar Dato a Partida de Descent (Mision actual, Mazo de Cartas de Overlord y Oro actual del grupo)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::put('descent/{idpartida}/general', [DescentPartidaController::class, 'actualizarGeneralPartidaDescent'])->middleware('descentGeneral.validate')->name('descent.partida.actualizar.general');
});

// Usuario - Listar las tablas con valores fijos
Route::get('descent/misiones/lista', [DescentPartidaController::class, 'listarMisionesDescent'])->name('descent.misiones.listar');
Route::get('descent/cartas/lista', [DescentPartidaController::class, 'listarCartasDescent'])->name('descent.misiones.listar');
Route::get('descent/heroes/lista', [DescentPartidaController::class, 'listarHeroesDescent'])->name('descent.heroes.listar');
Route::get('descent/equipo/lista', [DescentPartidaController::class, 'listarEquipoDescent'])->name('descent.equipo.listar');
Route::get('descent/habilidades/lista', [DescentPartidaController::class, 'listarHabilidadesDescent'])->name('descent.habilidades.listar');



// Usuario - Crear Heroe Partida de Descent
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('descent/{idpartida}/heroes', [DescentPartidaController::class, 'crearHeroePartidaDescent'])->name('descent.partida.crear.heroe');
});

// Usuario - Actualizar Heroe Partida de Descent
Route::group(['middleware' => ['auth:sanctum']], function(){
    //Route::put('descent/{idpartida}/heroes/{idheroe}', [DescentPartidaController::class, 'actualizarHeroePartidaDescent'])->middleware('descentHeroe.validate')->name('descent.partida.actualizar.heroe');
    Route::put('descent/{idpartida}/heroes', [DescentPartidaController::class, 'actualizarTodosHeroePartidaDescent'])->name('descent.partida.actualizar.heroe');
});

//  - Heroes (todos se muestran juntos en una vista, maximo 4)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('descent/{idpartida}/heroes', [DescentPartidaController::class, 'verHeroePartidaDescent'])->name('descent.partida.ver.heroes');
});

// Usuario - Eliminar Dato de Héroes de Partida de Descent
//      -- Héroe Seleccionado / Clase de Héroe / Equipamiento del Héroe
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('descent/{idparty}/heroes', [DescentPartidaController::class, 'eliminarHeroePartidaDescent'])->name('descent.partida.eliminar.heroe');
});




Route::put('descent/test', [DescentPartidaController::class, 'testsync'])->name('descent.partida.actualizar.general');




///////////////////////////////////////////////////////////////////////
//////////////             DESCENT - FORO                //////////////
///////////////////////////////////////////////////////////////////////

////////////// DISCUSIONES //////////////
// Usuario - Crear Discusión en el foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('descent/foro/discusion', [DescentForoController::class, 'crearDiscusionForoDescent'])->name('descent.foro.crear.discusion');
});

// Usuario - Ver sus discusiones del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('descent/foro/discusion/usuario', [DescentForoController::class, 'listarDiscusionesUsuarioForoDescent'])->name('descent.foro.ver.discusiones.usuario');
});

// Listar las Discusiones en el foro de Descent
Route::get('descent/foro/discusion', [DescentForoController::class, 'listarDiscusionesForoDescent'])->name('descent.foro.listar.discusiones');

// Usuario - ¿Editar Discusión del foro?

// Admin - Eliminar Discusión del foro (junto a todos sus mensajes)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('descent/foro/discusion/{iddiscusion}', [DescentForoController::class, 'eliminarDiscusionForoDescent'])->name('descent.foro.eliminar.discusion');
});


////////////// MENSAJES //////////////
// Usuario - Crear Mensaje de una discusión del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('descent/foro/mensaje/{idconversacion}', [DescentForoController::class, 'crearMensajeForoDescent'])->name('descent.foro.crear.mensaje');
});

// Listar Mensajes de un usuario del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('descent/foro/mensaje/usuario', [DescentForoController::class, 'listarMensajesUsuarioForoDescent'])->name('descent.foro.listar.mensajes');
});

// Listar Mensajes de una discusión del foro
Route::get('descent/foro/{idconversacion}/mensaje', [DescentForoController::class, 'listarMensajesDiscusionForoDescent'])->name('descent.foro.listar.mensajes');


// Usuario - ¿Editar Mensaje de una discusión del foro?

// Admin - Eliminar Mensaje de una discusión del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('descent/foro/mensaje/{idmensaje}', [DescentForoController::class, 'eliminarMensajeForoDescent'])->name('descent.foro.eliminar.mensaje');
});




///////////////////////////////////////////////////////////////////////
//////////////          GLOOMHAVEN - PARTIDA             //////////////
///////////////////////////////////////////////////////////////////////

// Usuario - Crear Partida de Gloomhaven
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('gloomhaven/partida', [GloomhavenPartidaController::class, 'crearPartidaGloomhaven'])->name('gloomhaven.partida.crear');
});

// Admin - Listar todas las Partidas de Gloomhaven
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('gloomhaven/partidas', [GloomhavenPartidaController::class, 'adminListarTodasLasPartidasGloomhaven'])->name('gloomhaven.admin.listar.partidas');
});

// Usuario - Listar Partidas de Gloomhaven de un usuario
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('gloomhaven/partidas/{id}', [GloomhavenPartidaController::class, 'listarPartidasGloomhavenUsuario'])->name('gloomhaven.partida.listar.partidas');
});

// Usuario - ¿Editar Partida de Gloomhaven?


// Usuario - Eliminar Partida de Gloomhaven
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('gloomhaven/partida/{id}', [GloomhavenPartidaController::class, 'eliminarPartidaGloomhaven'])->name('gloomhaven.partida.eliminar');
});


// Usuario - Ver Datos de Partida de Gloomhaven (Mision actual, Mazo de Cartas de Overlord y Oro actual del grupo)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('gloomhaven/{idpartida}/general', [GloomhavenPartidaController::class, 'verGeneralPartidaGloomhaven'])->name('gloomhaven.partida.ver.general');
});

// Usuario - Añadir/Actualizar Dato a Partida de Gloomhaven (Mision actual, Mazo de Cartas de Overlord y Oro actual del grupo)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::put('gloomhaven/{idpartida}/general', [GloomhavenPartidaController::class, 'actualizarGeneralPartidaGloomhaven'])->middleware('gloomhavenGeneral.validate')->name('gloomhaven.partida.actualizar.general');
});

// Usuario - Listar las tablas con valores fijos
// REVISAR ESTOS NOMBRES Y ACTUALIZARLOS A LAS TABLAS DE GLOOMHAVEN, ESTOS SON DE DESCENT
Route::get('gloomhaven/misiones/lista', [GloomhavenPartidaController::class, 'listarMisionesGloomhaven'])->name('gloomhaven.misiones.listar');
Route::get('gloomhaven/cartas/lista', [GloomhavenPartidaController::class, 'listarCartasGloomhaven'])->name('gloomhaven.misiones.listar');
Route::get('gloomhaven/heroes/lista', [GloomhavenPartidaController::class, 'listarHeroesGloomhaven'])->name('gloomhaven.heroes.listar');
Route::get('gloomhaven/equipo/lista', [GloomhavenPartidaController::class, 'listarEquipoGloomhaven'])->name('gloomhaven.equipo.listar');
Route::get('gloomhaven/habilidades/lista', [GloomhavenPartidaController::class, 'listarHabilidadesGloomhaven'])->name('gloomhaven.habilidades.listar');



// Usuario - Crear Heroe Partida de Gloomhaven
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('gloomhaven/{idpartida}/heroes', [GloomhavenPartidaController::class, 'crearHeroePartidaGloomhaven'])->name('gloomhaven.partida.crear.heroe');
});

// Usuario - Actualizar Heroe Partida de Gloomhaven
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::put('gloomhaven/{idpartida}/heroes', [GloomhavenPartidaController::class, 'actualizarTodosHeroePartidaGloomhaven'])->name('gloomhaven.partida.actualizar.heroe');
});

//  - Heroes (todos se muestran juntos en una vista, maximo 4)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('gloomhaven/{idpartida}/heroes', [GloomhavenPartidaController::class, 'verHeroePartidaGloomhaven'])->name('gloomhaven.partida.ver.heroes');
});

// Usuario - Eliminar Dato de Héroes de Partida de Gloomhaven
//      -- Héroe Seleccionado / Clase de Héroe / Equipamiento del Héroe
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('gloomhaven/{idparty}/heroes', [GloomhavenPartidaController::class, 'eliminarHeroePartidaGloomhaven'])->name('gloomhaven.partida.eliminar.heroe');
});

/* Datos: 
    - Mision actual
    - Logros Globales
    - Prosperidad Ciudad
    - Grupo de Heroes:
        -- Logros de Grupo
        -- Héroes:
            --- Clase de Héroe Seleccionada
            --- Equipamiento del Héroe
            --- Pericias del Héroe (Relacionadas con la clase)
            --- Habilidades del Héroe (Relacionadas con la clase)

        

*/
// Usuario - Añadir/Actualizar Dato a Partida de Gloomhaven

// Usuario - Ver Datos de Partida de Gloomhaven

// Usuario - Eliminar Dato de Héroes de Partida de Gloomhaven



///////////////////////////////////////////////////////////////////////
//////////////            GLOOMHAVEN - FORO              //////////////
///////////////////////////////////////////////////////////////////////

////////////// DISCUSIONES //////////////

// Usuario - Crear Discusión en el foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('gloomhaven/foro/discusion', [GloomhavenForoController::class, 'crearDiscusionForoGloomhaven'])->name('gloomhaven.foro.crear.discusion');
});

// Usuario - Ver sus discusiones del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('gloomhaven/foro/discusion/usuario', [GloomhavenForoController::class, 'listarDiscusionesUsuarioForoGloomhaven'])->name('gloomhaven.foro.ver.discusiones.usuario');
});

// Listar las Discusiones en el foro de Gloomhaven
Route::get('gloomhaven/foro/discusion', [GloomhavenForoController::class, 'listarDiscusionesForoGloomhaven'])->name('gloomhaven.foro.listar.discusiones');

// Usuario - ¿Editar Discusión del foro?

// Admin - Eliminar Discusión del foro (junto a todos sus mensajes)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('gloomhaven/foro/discusion/{iddiscusion}', [GloomhavenForoController::class, 'eliminarDiscusionForoGloomhaven'])->name('gloomhaven.foro.eliminar.discusion');
});

////////////// MENSAJES //////////////
// Usuario - Crear Mensaje de una discusión del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('gloomhaven/foro/mensaje/{idconversacion}', [GloomhavenForoController::class, 'crearMensajeForoGloomhaven'])->name('gloomhaven.foro.crear.mensaje');
});

// Usuario - Listar Mensajes de una discusión del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('gloomhaven/foro/mensaje/usuario', [GloomhavenForoController::class, 'listarMensajesUsuarioForoGloomhaven'])->name('gloomhaven.foro.listar.mensajes');
});

// Listar Mensajes de una discusión del foro
Route::get('gloomhaven/foro/{idconversacion}/mensaje', [GloomhavenForoController::class, 'listarMensajesDiscusionForoGloomhaven'])->name('gloomhaven.foro.listar.mensajes');

// Usuario - ¿Editar Mensaje de una discusión del foro?

// Admin - Eliminar Mensaje de una discusión del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('gloomhaven/foro/mensaje/{idmensaje}', [GloomhavenForoController::class, 'eliminarMensajeForoGloomhaven'])->name('gloomhaven.foro.eliminar.mensaje');
});

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/