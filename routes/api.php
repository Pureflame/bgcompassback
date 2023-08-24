<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DescentPartidaController;
use App\Http\Controllers\DescentForoController;
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

// ¿Actualizar Usuarios?

// ¿Eliminar Usuarios?



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
Route::get('menu-principal-partidas', [JuegosController::class, 'listarJuegos'])->middleware('')->name('menu.principal.partidas');
Route::get('menu-principal-foros', [JuegosController::class, 'listarForos'])->middleware('')->name('menu.principal.foros');

// Usuario Perfil - Listar Partidas creadas de todos los juegos
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('usuario-perfil/usuario/partidas/{id}', [UserController::class, 'listarPartidasUsuario'])->middleware('')->name('usuarios.perfil.usuario.listar.partidas');
});

// Usuario Perfil - Listar Discusiones del Foro de todos los juegos
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('usuario-perfil/usuario/discusiones/{id}', [UserController::class, 'listarDiscusionesUsuario'])->middleware('')->name('usuarios.perfil.usuario.listar.discusiones');
});

// Admin - Ver todas las Partidas creadas por un Usuario de todos los juegos
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('admin/partidas-usuario/{id}', [UserController::class, 'adminVerPartidasUsuario'])->middleware('')->name('admin.ver.partidas.usuario');
});

///////////////////////////////////////////////////////////////////////
//////////////                  OTROS                    //////////////
///////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////
//////////////           DESCENT - PARTIDA               //////////////
///////////////////////////////////////////////////////////////////////

// Usuario - Crear Partida de Descent
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('descent/partida', [DescentPartidaController::class, 'crearPartidaDescent'])->middleware('')->name('descent.partida.crear');
});

// Usuario - Listar Partidas de Descent
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('descent/partidas/{id}', [DescentPartidaController::class, 'listarPartidasDescent'])->middleware('')->name('descent.partida.listar.partidas');
});

// Usuario - ¿Editar Partida de Descent?

// Usuario - Eliminar Partida de Descent(y todo lo que contiene)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('descent/partida/{id}', [DescentPartidaController::class, 'eliminarPartidaDescent'])->name('descent.partida.eliminar');
});


/* Datos: 
    - Mision actual
    - Mazo de Cartas de Overlord
    - Oro actual del grupo
    - Heroes:
        -- Héroe Seleccionado
        -- Clase de Héroe
        -- Equipamiento del Héroe
*/

// Usuario - Añadir/Actualizar Dato a Partida de Descent
//  - Mision actual, Mazo de Cartas de Overlord y Oro actual del grupo (comparten un formulario)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::put('descent/{idpartida}/general', [DescentPartidaController::class, 'actualizarGeneralPartidaDescent'])->name('descent.partida.actualizar.general');
});


    Route::put('descent/test', [DescentPartidaController::class, 'testsync'])->name('descent.partida.actualizar.general');


//  - Heroes 
//      -- Héroe Seleccionado / Clase de Héroe / Equipamiento del Héroe
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::put('descent/{idpartida}/heroes/{idheroe}', [DescentPartidaController::class, 'actualizarHeroePartidaDescent'])->middleware('')->name('descent.partida.actualizar.heroe');
});



// Usuario - Ver Datos de Partida de Descent
//  - Mision actual, Mazo de Cartas de Overlord y Oro actual del grupo
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('descent/{idpartida}/general', [DescentPartidaController::class, 'verGeneralPartidaDescent'])->name('descent.partida.ver.general');
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

///////////////////////////////////////////////////////////////////////
//////////////             DESCENT - FORO                //////////////
///////////////////////////////////////////////////////////////////////

// Usuario - Ver sus discusiones del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('descent/foro/discusiones/{id}', [DescentForoController::class, 'verDiscusionesUsuarioForoDescent'])->middleware('')->name('descent.foro.ver.discusiones.usuario');
});

// Usuario - Crear Discusión en el foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('descent/foro/discusion', [DescentForoController::class, 'crearDiscusionForoDescent'])->middleware('')->name('descent.foro.crear.discusion');
});

// Listar Discusiones en el foro
Route::get('descent/foro/discusion', [DescentForoController::class, 'listarDiscusionesForoDescent'])->middleware('')->name('descent.foro.listar.discusiones');

// Usuario - ¿Editar Discusión del foro?

// Admin - Eliminar Discusión del foro (junto a todos sus mensajes)
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('descent/foro/discusion/{iddiscusion}', [DescentForoController::class, 'eliminarDiscusionForoDescent'])->middleware('')->name('descent.foro.eliminar.discusion');
});

// Usuario - Crear Mensaje de una discusión del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('descent/foro/mensaje', [DescentForoController::class, 'crearMensajeForoDescent'])->middleware('')->name('descent.foro.crear.mensaje');
});

// Listar Mensajes de una discusión del foro
Route::get('descent/foro/mensaje', [DescentForoController::class, 'listarMensajesForoDescent'])->middleware('')->name('descent.foro.listar.mensajes');

// Usuario - ¿Editar Mensaje de una discusión del foro?

// Admin - Eliminar Mensaje de una discusión del foro
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('descent/foro/mensaje/{idmensaje}', [DescentForoController::class, 'eliminarMensajeForoDescent'])->middleware('')->name('descent.foro.eliminar.mensaje');
});




///////////////////////////////////////////////////////////////////////
//////////////          GLOOMHAVEN - PARTIDA             //////////////
///////////////////////////////////////////////////////////////////////

// Usuario - Crear Partida de Gloomhaven

// Usuario - Listar Partidas de Gloomhaven

// Usuario - ¿Editar Partida de Gloomhaven?

// Usuario - Eliminar Partida de Gloomhaven




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

// Usuario - Ver sus discusiones del foro

// Usuario - Crear Discusión en el foro

// Usuario - Listar Discusión en el foro

// Usuario - ¿Editar Discusión del foro?

// Admin - Eliminar Discusión del foro (junto a todos sus mensajes)


// Usuario - Crear Mensaje de una discusión del foro

// Usuario - Listar Mensajes de una discusión del foro

// Usuario - ¿Editar Mensaje de una discusión del foro?

// Admin - Eliminar Mensaje de una discusión del foro


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/