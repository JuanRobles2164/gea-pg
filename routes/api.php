<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchivoController;

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
