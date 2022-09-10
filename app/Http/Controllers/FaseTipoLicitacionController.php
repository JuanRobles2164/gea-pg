<?php

namespace App\Http\Controllers;

use App\Models\FaseTipoLicitacion;
use App\Http\Requests\StoreFaseTipoLicitacionRequest;
use App\Http\Requests\UpdateFaseTipoLicitacionRequest;
use App\Repositories\FaseTipoLicitacion\FaseTipoLicitacionRepository;
use Illuminate\Http\Request;

class FaseTipoLicitacionController extends Controller
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
        $this->repo = FaseTipoLicitacionRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = FaseTipoLicitacionRepository::GetInstance();
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
     * @param  \App\Http\Requests\StoreFaseTipoLicitacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo = FaseTipoLicitacionRepository::GetInstance();
        $data = $request->all();
        $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FaseTipoLicitacion  $faseTipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function show(FaseTipoLicitacion $faseTipoLicitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaseTipoLicitacion  $faseTipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(FaseTipoLicitacion $faseTipoLicitacion)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFaseTipoLicitacionRequest  $request
     * @param  \App\Models\FaseTipoLicitacion  $faseTipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FaseTipoLicitacion $faseTipoLicitacion)
    {
        $this->repo = FaseTipoLicitacionRepository::GetInstance();
        $data = $request->all();
        $faseTipoLicitacion = $this->repo->find($data["id"]);
        $this->repo->update($faseTipoLicitacion, $data);
        $this->repo = null;
        return json_encode($faseTipoLicitacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaseTipoLicitacion  $faseTipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $faseTipoLicitacion)
    {
        $objeto = new FaseTipoLicitacion($faseTipoLicitacion->all());
        $objeto->id = $faseTipoLicitacion->id;
        $this->repo = FaseTipoLicitacionRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }
}
