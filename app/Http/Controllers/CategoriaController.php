<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Repositories\Categoria\CategoriaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repo = CategoriaRepository::GetInstance();
        $lista = $this->repo->getAllEstado();
        $this->repo = null;
        $allData = ['categorias' => $lista];
        return view('Licitacion.categorias_index', $allData);
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = CategoriaRepository::GetInstance();
        $lista = $this->repo->getAllEstado($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $this->repo = CategoriaRepository::GetInstance();
        $obj = $this->repo->find($request->id);
        $this->repo = null;

        $allData = ['categoria'=> $obj];
        return json_encode($allData);
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
     * @param  \App\Http\Requests\StoreCategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo = CategoriaRepository::GetInstance();
        $data = $request->all();
        $data = $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriaRequest  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $this->repo = CategoriaRepository::GetInstance();
        $data = $request->all();
        $categoria = $this->repo->find($data["id"]);
        $this->repo->update($categoria, $data);
        $this->repo = null;
        return json_encode($categoria);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Categoria $categoria)
    {
        $this->repo = CategoriaRepository::GetInstance();
        $data = $request->all();
        $data["estado"] = '3';
        $categoria = $this->repo->find($data["id"]);
        $this->repo->update($categoria, $data);
        $this->repo = null;
        return json_encode($categoria);
    }
}
