<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\FaseTipoDocumentoController;
use App\Http\Controllers\LicitacionController;
use App\Http\Controllers\LicitacionFaseController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolUsuarioController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\TipoLicitacionController;
use App\Http\Controllers\UserController;
use App\Models\FaseTipoLicitacion;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name("fase_tipo_documento.")->group(function(){
    Route::controller(FaseTipoDocumentoController::class)->group(function(){
        Route::get('/fase_tipo_documento/listar', 'listar')->name("listar");
        Route::post('/fase_tipo_documento/store', 'store')->name("guardar");
        Route::post('/fase_tipo_documento/store_all', 'storeAll')->name("guardar_todo");
        Route::post('/fase_tipo_documento/update', 'update')->name("actualizar");
        Route::post('/fase_tipo_documento/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("usuario.")->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('/usuario/listar', 'listar')->name("listar");
        Route::get('/usuario/find', 'details')->name("encontrar");
        Route::post('/usuario/store', 'store')->name("guardar");
        Route::post('/usuario/update', 'update')->name("actualizar");
        Route::post('/usuario/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("rol_usuario.")->group(function(){
    Route::controller(RolUsuarioController::class)->group(function(){
        Route::get('/rol_usuario/listar', 'listar')->name("listar");
        Route::post('/rol_usuario/store', 'store')->name("guardar");
        Route::post('/rol_usuario/update_roles', 'updateRoles')->name("actualizar_multiple");
        Route::post('/rol_usuario/update', 'update')->name("actualizar");
        Route::post('/rol_usuario/destroy', 'destroy')->name("eliminar");
        Route::post('/rol_usuario/agregar', 'agregar')->name("agregar");
    });
});

Route::name("rol.")->group(function(){
    Route::controller(RolController::class)->group(function(){
        Route::get('/rol/listar', 'listar')->name("listar");
        Route::post('/rol/store', 'store')->name("guardar");
        Route::post('/rol/update', 'update')->name("actualizar");
        Route::post('/rol/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("cliente.")->group(function(){
    Route::controller(ClienteController::class)->group(function(){
        Route::get('/cliente/listar', 'listar')->name("listar");
        Route::post('/cliente/store', 'store')->name("guardar");
        Route::post('/cliente/update', 'update')->name("actualizar");
        Route::post('/cliente/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("documento.")->group(function(){
    Route::controller(DocumentoController::class)->group(function(){
        Route::get('/documento/listar', 'listar')->name("listar");
        Route::post('/documento/store', 'store')->name("guardar");
        Route::post('/documento/update', 'update')->name("actualizar");
        Route::post('/documento/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("tipo_licitacion.")->group(function(){
    Route::controller(TipoLicitacionController::class)->group(function(){
        Route::get('/tipo_licitacion/listar', 'listar')->name("listar");
        Route::post('/tipo_licitacion/store', 'store')->name("guardar");
        Route::post('/tipo_licitacion/update', 'update')->name("actualizar");
        Route::post('/tipo_licitacion/destroy', 'destroy')->name("eliminar");
    });
});

/* Route::name("empresa.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/empresa/listar', 'listar')->name("listar");
        Route::post('/empresa/store', 'store')->name("guardar");
        Route::post('/empresa/update', 'update')->name("actualizar");
        Route::post('/empresa/destroy', 'destroy')->name("eliminar");
    });
}); */

Route::name("estado.")->group(function(){
    Route::controller(EstadoController::class)->group(function(){
        Route::get('/estado/listar', 'listar')->name("listar");
        Route::post('/estado/store', 'store')->name("guardar");
        Route::post('/estado/update', 'update')->name("actualizar");
        Route::post('/estado/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("fase.")->group(function(){
    Route::controller(FaseController::class)->group(function(){
        Route::get('/fase/listar', 'listar')->name("listar");
        Route::post('/fase/store', 'store')->name("guardar");
        Route::post('/fase/update', 'update')->name("actualizar");
        Route::post('/fase/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("fase_tipo_licitacion.")->group(function(){
    Route::controller(FaseTipoLicitacion::class)->group(function(){
        Route::get('/fase_tipo_licitacion/listar', 'listar')->name("listar");
        Route::post('/fase_tipo_licitacion/store', 'store')->name("guardar");
        Route::post('/fase_tipo_licitacion/update', 'update')->name("actualizar");
        Route::post('/fase_tipo_licitacion/destroy', 'destroy')->name("eliminar");
    });
});

/* Route::name("fase_tipo_tipo_licitacion.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/fase_tipo_tipo_licitacion/listar', 'listar')->name("listar");
        Route::post('/fase_tipo_tipo_licitacion/store', 'store')->name("guardar");
        Route::post('/fase_tipo_tipo_licitacion/update', 'update')->name("actualizar");
        Route::post('/fase_tipo_tipo_licitacion/destroy', 'destroy')->name("eliminar");
    });
});*/

Route::name("licitacion.")->group(function(){
    Route::controller(LicitacionController::class)->group(function(){
        Route::get('/licitacion/listar', 'listar')->name("listar");
        Route::post('/licitacion/store', 'store')->name("guardar");
        Route::post('/licitacion/update', 'update')->name("actualizar");
        Route::post('/licitacion/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("licitacion_fase.")->group(function(){
    Route::controller(LicitacionFaseController::class)->group(function(){
        Route::get('/licitacion_fase/listar', 'listar')->name("listar");
        Route::post('/licitacion_fase/store', 'store')->name("guardar");
        Route::post('/licitacion_fase/update', 'update')->name("actualizar");
        Route::post('/licitacion_fase/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("tipo_documento.")->group(function(){
    Route::controller(TipoDocumentoController::class)->group(function(){

        Route::get('/tipo_documento/listar', 'listar')->name("listar");
        Route::get('/tipo_documento/find', 'find')->name("encontrar");
        Route::post('/tipo_documento/store', 'store')->name("guardar");
        Route::post('/tipo_documento/update', 'update')->name("actualizar");
        Route::post('/tipo_documento/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("tipo_licitacion.")->group(function(){
    Route::controller(TipoLicitacionController::class)->group(function(){
        Route::get('/tipo_licitacion/listar', 'listar')->name("listar");
        Route::post('/tipo_licitacion/store', 'store')->name("guardar");
        Route::post('/tipo_licitacion/update', 'update')->name("actualizar");
        Route::post('/tipo_licitacion/destroy', 'destroy')->name("eliminar");
    });
});

