<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Http\Requests\StorearchivoRequest;
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
    public function store(StorearchivoRequest $request)
    {
        $this->repo = ArchivoRepository::GetInstance();
        $data = $request->all();
        $objeto = new Archivo($data);
        $this->repo->create($objeto);
        $this->repo = null;
        return json_encode($objeto);
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
    public function update(UpdatearchivoRequest $request, Archivo $archivo)
    {
        $this->repo = ArchivoRepository::GetInstance();
        $data = $request->all();
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
    public function destroy(archivo $archivo)
    {
        $this->repo = ArchivoRepository::GetInstance();
        $this->repo->delete($archivo);
        $this->repo = null;
        return json_encode($archivo);
    }
}
