<?php

namespace App\Http\Controllers;

use App\Models\TipoLicitacion;
use App\Http\Requests\StoreTipoLicitacionRequest;
use App\Http\Requests\UpdateTipoLicitacionRequest;
use App\Repositories\TipoLicitacion\TipoLicitacionRepository;
use Illuminate\Http\Request;

class TipoLicitacionController extends Controller
{
    private $repo = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repo = TipoLicitacionRepository::GetInstance();
        $lista = $this->repo->getAll();
        $this->repo = null;

        $allData = ['tipos_licitacion' => $lista,
        ];
        return view('TipoLicitacion.index', $allData);
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = TipoLicitacionRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = TipoLicitacionRepository::GetInstance();
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
     * @param  \App\Http\Requests\StoreTipoLicitacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo = TipoLicitacionRepository::GetInstance();
        $data = $request->all();
        $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoLicitacion  $tipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function show(TipoLicitacion $tipoLicitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoLicitacion  $tipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoLicitacion $tipoLicitacion)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoLicitacionRequest  $request
     * @param  \App\Models\TipoLicitacion  $tipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoLicitacion $tipoLicitacion)
    {
        $this->repo = TipoLicitacionRepository::GetInstance();
        $data = $request->all();
        $tipoLicitacion = $this->repo->find($data["id"]);
        $this->repo->update($tipoLicitacion, $data);
        $this->repo = null;
        return json_encode($tipoLicitacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoLicitacion  $tipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $tipoLicitacion)
    {
        $objeto = new TipoLicitacion($tipoLicitacion->all());
        $objeto->id = $tipoLicitacion->id;
        $this->repo = TipoLicitacionRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }
}
