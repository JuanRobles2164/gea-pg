<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\TipoDocumentoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Como seguiremos usando sólo la API, entonces dejaremos sólo las rutas que devuelvan las vistas en este archivo

Route::name("estado.")->group(function(){
    Route::controller(EstadoController::class)->group(function(){
        Route::get('/estado/index', 'index')->name("index");
    });
});

Route::name("cliente.")->group(function(){
    Route::controller(ClienteController::class)->group(function(){
        Route::get('/cliente/index', 'index')->name("index");
    });
});

Route::name("fase.")->group(function(){
    Route::controller(ClienteController::class)->group(function(){
        Route::get('/fase/index', 'index')->name("index");
    });
});

Route::name("tipo_documento.")->group(function(){
    Route::controller(TipoDocumentoController::class)->group(function(){
        Route::get('/tipo_documento/index', 'index')->name("index");
    });
});

