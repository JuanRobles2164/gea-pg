<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Repositories\Categoria\CategoriaRepository;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    private $repo = null;

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = CategoriaRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorecategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo = CategoriaRepository::GetInstance();
        $data = $request->all();
        $objeto = new Categoria($data);
        $this->repo->create($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoriaRequest  $request
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categoria $categoria)
    {
        $this->repo = CategoriaRepository::GetInstance();
        $data = $request->all();
        $this->repo->update($categoria, $data);
        $this->repo = null;
        return json_encode($categoria);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(categoria $categoria)
    {
        $this->repo = CategoriaRepository::GetInstance();
        $this->repo->delete($categoria);
        $this->repo = null;
        return json_encode($categoria);
    }
}
