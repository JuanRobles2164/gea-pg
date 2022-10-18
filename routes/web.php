<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\TipoLicitacionController;
use App\Http\Controllers\LicitacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DocumentoPrincipalController;
use App\Http\Controllers\UserController;
use App\Repositories\Estado\EstadoRepository;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {
        $repo = EstadoRepository::GetInstance();
        $lista = $repo->getAll();
        $repo = null;
        $allData = ['estados' => $lista];
        return view('pages.icons', $allData);
    })->name('icons'); 
	 Route::get('table-list', function () {return view('pages.usuarios');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});



//Como seguiremos usando sólo la API, entonces dejaremos sólo las rutas que devuelvan las vistas en este archivo

Route::name("estado.")->group(function(){
    Route::controller(EstadoController::class)->group(function(){
        Route::get('/estado/index', 'index')->name("index");
    });
});

Route::name("documento_principal.")->group(function(){
    Route::controller(DocumentoPrincipalController::class)->group(function(){
        Route::get('/documento_principal/index', 'index')->name("index");
        Route::post('/documento_principal/guardar_documento', 'guardarDocumento')->name("guardar_documento_no_api");
    });
});


Route::name("usuario.")->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('/usuario/index', 'index')->name("index");
    });
});

Route::name("cliente.")->group(function(){
    Route::controller(ClienteController::class)->group(function(){
        Route::get('/cliente/index', 'index')->name("index");
    });
});

Route::name("fase.")->group(function(){
    Route::controller(FaseController::class)->group(function(){
        Route::get('/fase/index', 'index')->name("index");
    });
});

Route::name("tipo_documento.")->group(function(){
    Route::controller(TipoDocumentoController::class)->group(function(){
        Route::get('/tipo_documento/index', 'index')->name("index");
    });
});


Route::name("tipo_licitacion.")->group(function(){
    Route::controller(TipoLicitacionController::class)->group(function(){
        Route::get('/tipo_licitacion/index', 'index')->name("index");
    });
});

Route::name("licitacion.")->group(function(){
    Route::controller(CategoriaController::class)->group(function(){
        Route::get('/licitacion/categorias', 'index')->name("categorias");
    });
    Route::controller(LicitacionController::class)->group(function(){
        Route::get('/licitacion/index', 'index')->name("index");
    });
    Route::controller(LicitacionController::class)->group(function(){
        Route::get('/licitacion/edit', 'edit')->name("edit");
    });
});
