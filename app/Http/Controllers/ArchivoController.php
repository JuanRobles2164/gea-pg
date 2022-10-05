<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Http\Requests\UpdatearchivoRequest;
use App\Repositories\Archivo\ArchivoRepository;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    private $repo = null;
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
        $this->repo = ArchivoRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = ArchivoRepository::GetInstance();
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
     * @param  \App\Http\Requests\StorearchivoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->repo = ArchivoRepository::GetInstance();
        $data = $request->all();
        $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function show(archivo $archivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function edit(archivo $archivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatearchivoRequest  $request
     * @param  \App\Models\archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archivo $archivo)
    {
        
        $this->repo = ArchivoRepository::GetInstance();
        $data = $request->all();
        $archivo = $this->repo->find($data["id"]);
        $this->repo->update($archivo, $data);
        $this->repo = null;
        return json_encode($archivo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $archivo)
    {
        $objeto = new Archivo($archivo->all());
        $objeto->id = $archivo->id;
        $this->repo = ArchivoRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }
}
