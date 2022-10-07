<?php

namespace App\Http\Controllers;

use App\Models\Licitacion;
use App\Http\Requests\StoreLicitacionRequest;
use App\Http\Requests\UpdateLicitacionRequest;
use App\Repositories\Categoria\CategoriaRepository;
use App\Repositories\Cliente\ClienteRepository;
use App\Repositories\Licitacion\LicitacionRepository;
use Illuminate\Http\Request;

class LicitacionController extends Controller
{
    private $repo = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Licitacion.index');
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = LicitacionRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = LicitacionRepository::GetInstance();
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
     * @param  \App\Http\Requests\StoreLicitacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo = CategoriaRepository::GetInstance();
        //Intentará buscar primero un registro de Categoria que concuerde con el nombre, si no lo encuentra, lo creará
        $categoria = $this->repo->firstOrCreate([
            'nombre' => $request->categoria
        ]);
        $this->repo = null;

        $this->repo = LicitacionRepository::GetInstance();
        $data = $request->all();
        $data["categoria"] = $categoria->id;

        $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function show(Licitacion $licitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Licitacion $licitacion)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLicitacionRequest  $request
     * @param  \App\Models\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Licitacion $licitacion)
    {
        $this->repo = LicitacionRepository::GetInstance();
        $data = $request->all();
        $licitacion = $this->repo->find($data["id"]);
        $this->repo->update($licitacion, $data);
        $this->repo = null;
        return json_encode($licitacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $licitacion)
    {
        $objeto = new Licitacion($licitacion->all());
        $objeto->id = $licitacion->id;
        $this->repo = LicitacionRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }
}
