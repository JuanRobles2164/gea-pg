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

Route::name("archivo.")->group(function(){
    Route::controller(ArchivoController::class)->group(function(){
        Route::get('/archivo/listar', 'listar')->name("listar");
        Route::post('/archivo/store', 'store')->name("guardar");
        Route::post('/archivo/update', 'update')->name("actualizar");
        Route::post('/archivo/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("categoria.")->group(function(){
    Route::controller(CategoriaController::class)->group(function(){
        Route::get('/categoria/listar', 'listar')->name("listar");
        Route::post('/categoria/store', 'store')->name("guardar");
        Route::post('/categoria/update', 'update')->name("actualizar");
        Route::post('/categoria/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("documento_archivo.")->group(function(){
    Route::controller(DocumentoArchivoController::class)->group(function(){
        Route::get('/documento_archivo/listar', 'listar')->name("listar");
        Route::post('/documento_archivo/store', 'store')->name("guardar");
        Route::post('/documento_archivo/update', 'update')->name("actualizar");
        Route::post('/documento_archivo/destroy', 'destroy')->name("eliminar");
    });
});

Route::name("documento_categoria.")->group(function(){
    Route::controller(DocumentoCategoriaController::class)->group(function(){
        Route::get('/documento_categoria/listar', 'listar')->name("listar");
        Route::post('/documento_categoria/store', 'store')->name("guardar");
        Route::post('/documento_categoria/update', 'update')->name("actualizar");
        Route::post('/documento_categoria/destroy', 'destroy')->name("eliminar");
    });
});
