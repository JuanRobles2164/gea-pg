<?php

namespace App\Http\Controllers;

use App\Models\RolUsuario;
use App\Http\Requests\StoreRolUsuarioRequest;
use App\Http\Requests\UpdateRolUsuarioRequest;
use App\Repositories\RolUsuario\RolUsuarioRepository;
use Illuminate\Http\Request;

class RolUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = RolUsuarioRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = RolUsuarioRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo = RolUsuarioRepository::GetInstance();
        $data = $request->all();
        $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRolRequest  $request
     * @param  \App\Models\Rol  $Rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RolUsuario $Rol)
    {
        $this->repo = RolUsuarioRepository::GetInstance();
        $data = $request->all();
        $Rol = $this->repo->find($data["id"]);
        $this->repo->update($Rol, $data);
        $this->repo = null;
        return json_encode($Rol);
    }

    public function destroy(Request $Rol)
    {
        $objeto = new RolUsuario($Rol->all());
        $objeto->id = $Rol->id;
        $this->repo = RolUsuarioRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }

    public function updateRoles(Request $request){
        $roles = [];
        foreach($request->roles as $r){
            array_push($roles, ['rol' => $r, 'usuario' => $request->id]);
        }
        if(count($roles) == 0){
            return json_encode(['status' => "No hay roles seleccionados"]);
        }
        $this->repo = RolUsuarioRepository::GetInstance();
        $response = $this->repo->updateRoles($roles);
        return json_encode(['status' => $response]);
    }

    public function agregar(Request $request){
        $this->repo = RolUsuarioRepository::GetInstance();
        $usuarioId = $request->id;
        $rolesIds = $request->roles;
        $rolesObjs = [];

        for($i = 0; $i < count($rolesIds); $i++){
            $objeto = [
                'usuario' => $usuarioId,
                'rol' => $rolesIds[$i]
            ];
            array_push($rolesObjs, $this->repo->asignarRol($objeto));
        }
        return $rolesObjs;
    }
}
