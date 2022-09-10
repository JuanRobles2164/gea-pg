<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DocumentoArchivoController;
use App\Http\Controllers\DocumentoCategoriaController;

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

Route::name("cliente.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/cliente/listar', 'listar')->name("listar");
        Route::post('/cliente/store', 'store')->name("guardar");
        Route::post('/cliente/update', 'update')->name("actualizar");
        Route::post('/cliente/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("documento.")->group(function(){
    Route::controller(DocumentoArchivoController::class)->group(function(){
        Route::get('/documento/listar', 'listar')->name("listar");
        Route::post('/documento/store', 'store')->name("guardar");
        Route::post('/documento/update', 'update')->name("actualizar");
        Route::post('/documento/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("documento_tipo_licitacion.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/documento_tipo_licitacion/listar', 'listar')->name("listar");
        Route::post('/documento_tipo_licitacion/store', 'store')->name("guardar");
        Route::post('/documento_tipo_licitacion/update', 'update')->name("actualizar");
        Route::post('/documento_tipo_licitacion/destroy', 'destroy')->name("eliminar");
    });
});


Route::name("tipo_licitacion.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/tipo_licitacion/listar', 'listar')->name("listar");
        Route::post('/tipo_licitacion/store', 'store')->name("guardar");
        Route::post('/tipo_licitacion/update', 'update')->name("actualizar");
        Route::post('/tipo_licitacion/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("empresa.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/empresa/listar', 'listar')->name("listar");
        Route::post('/empresa/store', 'store')->name("guardar");
        Route::post('/empresa/update', 'update')->name("actualizar");
        Route::post('/empresa/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("estado.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/estado/listar', 'listar')->name("listar");
        Route::post('/estado/store', 'store')->name("guardar");
        Route::post('/estado/update', 'update')->name("actualizar");
        Route::post('/estado/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("fase.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/fase/listar', 'listar')->name("listar");
        Route::post('/fase/store', 'store')->name("guardar");
        Route::post('/fase/update', 'update')->name("actualizar");
        Route::post('/fase/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("fase_tipo_licitacion.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/fase_tipo_licitacion/listar', 'listar')->name("listar");
        Route::post('/fase_tipo_licitacion/store', 'store')->name("guardar");
        Route::post('/fase_tipo_licitacion/update', 'update')->name("actualizar");
        Route::post('/fase_tipo_licitacion/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("fase_tipo_tipo_licitacion.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/fase_tipo_tipo_licitacion/listar', 'listar')->name("listar");
        Route::post('/fase_tipo_tipo_licitacion/store', 'store')->name("guardar");
        Route::post('/fase_tipo_tipo_licitacion/update', 'update')->name("actualizar");
        Route::post('/fase_tipo_tipo_licitacion/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("licitacion.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/licitacion/listar', 'listar')->name("listar");
        Route::post('/licitacion/store', 'store')->name("guardar");
        Route::post('/licitacion/update', 'update')->name("actualizar");
        Route::post('/licitacion/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("licitacion_fase.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/licitacion_fase/listar', 'listar')->name("listar");
        Route::post('/licitacion_fase/store', 'store')->name("guardar");
        Route::post('/licitacion_fase/update', 'update')->name("actualizar");
        Route::post('/licitacion_fase/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("tipo_documento.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/tipo_documento/listar', 'listar')->name("listar");
        Route::post('/tipo_documento/store', 'store')->name("guardar");
        Route::post('/tipo_documento/update', 'update')->name("actualizar");
        Route::post('/tipo_documento/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("tipo_licitacion.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/tipo_licitacion/listar', 'listar')->name("listar");
        Route::post('/tipo_licitacion/store', 'store')->name("guardar");
        Route::post('/tipo_licitacion/update', 'update')->name("actualizar");
        Route::post('/tipo_licitacion/destroy', 'destroy')->name("eliminar");
    });
});

