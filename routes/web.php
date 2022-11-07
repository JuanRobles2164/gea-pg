<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\TipoLicitacionController;
use App\Http\Controllers\LicitacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DocumentoLicitacionController;
use App\Http\Controllers\DocumentoPrincipalController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LicitacionFaseController;
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



Route::name('errores.')->group(function(){
    Route::controller(HomeController::class)->group(function(){
        Route::get('/error/403', 'forbiddenPage')->name('403');
    });
});

//Como seguiremos usando sólo la API, entonces dejaremos sólo las rutas que devuelvan las vistas en este archivo

Route::name("estado.")->group(function(){
    Route::controller(EstadoController::class)->group(function(){
        Route::get('/estado/index', 'index')->name("index");
    });
});

Route::name("empresa.")->group(function(){
    Route::controller(EmpresaController::class)->group(function(){
        Route::get('/empresa/index', 'index')->name("index");
        Route::post('/empresa/update', 'update')->name("actualizar");
        Route::post('/empresa/crear', 'store')->name("crear");
    });
});

Route::name("documento_principal.")->group(function(){
    Route::controller(DocumentoPrincipalController::class)->group(function(){
        Route::get('/documento_principal/index', 'index')->name("index");
        Route::get('/documento_principal/gestion', 'gestion')->name("gestion");
        Route::get('/documento_principal/editar', 'editar')->name("editar");

        Route::post('/documento_principal/guardar_documento/sube_doc_temporal', 'subirDocTemporal')->name('doc_temporal');
        Route::post('/documento_principal/guardar_documento', 'guardarDocumento')->name("guardar_documento_no_api");
        Route::post('/documento_principal/editar_documento', 'editarDocumento')->name("editar_documento_no_api");
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

Route::name("licitacion_fase.")->group(function(){
    Route::controller(LicitacionFaseController::class)->group(function(){
        Route::post('/licitacion_fase/reabrirFase', 'reabrirFase')->name("reabrir_fase");
    });
});

Route::name("documento.")->group(function(){
    Route::controller(DocumentoController::class)->group(function(){
        Route::get('/documento/index', 'index')->name("index");
        Route::post('/documento/store_in_component', 'storeInComponent')->name("guardar_en_componente");
        Route::post('/documento/replace_in_component', 'reemplazarDocumento')->name("reemplazar_en_componente");
        Route::get('/documento/eliminar_documento_licitacion', 'eliminarDocumentoLicitacion')->name("eliminar_documento_licitacion");
        Route::get('/documento/eliminar_documento_licitacion_relacion', 'eliminarDocumentoLicitacionRelacion')->name("eliminar_documento_licitacion_relacion");
    });
});

Route::name("documento_licitacion.")->group(function(){
    Route::controller(DocumentoLicitacionController::class)->group(function(){
        Route::post('/documento_licitacion/asociar_documentos_from_component', 'asociarDocumentosFromComponent')->name("asociar_documentos_from_component");
    });
});

Route::name("tipo_licitacion.")->group(function(){
    Route::controller(TipoLicitacionController::class)->group(function(){
        Route::get('/tipo_licitacion/index', 'index')->name("index");
    });
});

Route::name("categoria.")->group(function(){
    Route::controller(CategoriaController::class)->group(function(){
        Route::get('/categoria/index', 'index')->name("index");
    });
});

Route::name("licitacion.")->group(function(){
    Route::controller(LicitacionController::class)->group(function(){
        Route::get('/licitacion/index', 'index')->name("index");
        Route::get('/licitacion/gestionar_documentos_licitacion', 'gestionDocumentosIndex')->name("gestion_documentos_index");
        Route::get('/licitacion/create', 'create')->name("create");
        Route::post('/licitacion/create_entity', 'storeInView')->name("crear_post");
        Route::post('/licitacion/reabrir_licitacion', 'reabrirLicitacion')->name("reabrir_licitacion");
    });
});
