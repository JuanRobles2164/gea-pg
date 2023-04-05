<?php

namespace App\Http\Controllers;

use App\Http\Util\Utilidades;
use App\Models\Rol;
use App\Repositories\Licitacion\LicitacionRepository;
use App\Repositories\RolUsuario\RolUsuarioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private $repo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function forbiddenPage(){
        return view('Errors.403');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {   
        //Verifica primero que la cuenta no esté inhabilitada/inactiva/eliminada
        $activa = false;
        $usuario = Auth::user();
        if($usuario->estado == 3 || $usuario->estado == 2){
            $activa = false;
        }else{
            $activa = true;
        }
        if(!$activa){
            Session::flush();
            return Redirect::route('errores.403');
        }
        //Asigna los roles al usuario, alv
        if(!$request->session()->has('roles_usuario')){
            $usuario = Auth::user();
            $this->repo = RolUsuarioRepository::GetInstance();
            $roles_ids = [];
            foreach($this->repo->obtenerRolesPorUsuario($usuario->id) as $rol_user){
                array_push($roles_ids, $rol_user->rol);
            }
            $request->session()->put('roles_usuario', $roles_ids);
        }
        if(Utilidades::verificarPermisos(session()->get('roles_usuario'), [Rol::IS_ADMIN])){
            return Redirect::route('usuario.index');
        }
        //return $request->session()->get('roles_usuario');

        //Setea la información de la pantalla
        $this->repo = LicitacionRepository::GetInstance();
        $creadasMes = null;
        $creadasMes = $this->repo->getLicitacionesCreadasMes();
        $vencerMes = null;
        $vencerMes = $this->repo->getLicitacionesPorVencer();
        
        $allData = [
            'creadasMes' => $creadasMes,
            'vencerMes' => $vencerMes
        ];
        $this->repo = null;
        return view('dashboard', $allData);
    }
}
