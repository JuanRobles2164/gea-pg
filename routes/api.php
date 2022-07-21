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

Route::controller(ArchivoController::class)->group(function(){
    Route::get('/archivo/listar', 'listar');
    Route::post('/archivo/store', 'store');
    Route::post('/archivo/update', 'update');
    Route::post('/archivo/destroy', 'destroy');
});
