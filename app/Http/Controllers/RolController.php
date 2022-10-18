<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Repositories\Rol\RolRepository;
use Illuminate\Http\Request;


class RolController extends Controller
{
    private $validationRules = [
        'nombre' => 'required',
        'descripcion' => 'required'
    ];
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
        $this->repo = RolRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = RolRepository::GetInstance();
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

    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $this->repo = RolRepository::GetInstance();
        $data = $request->all();
        $data = $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rol  $Rol
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $Rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rol  $Rol
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $Rol)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRolRequest  $request
     * @param  \App\Models\Rol  $Rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $Rol)
    {
        $request->validate($this->validationRules);
        
        $this->repo = RolRepository::GetInstance();
        $data = $request->all();
        $Rol = $this->repo->find($data["id"]);
        $this->repo->update($Rol, $data);
        $this->repo = null;
        return json_encode($Rol);
    }

    public function destroy(Request $Rol)
    {
        $objeto = new Rol($Rol->all());
        $objeto->id = $Rol->id;
        $this->repo = RolRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }

}
