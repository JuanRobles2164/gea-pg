<?php

namespace App\Http\Controllers;

use App\Models\LicitacionFase;
use App\Http\Requests\StoreLicitacionFaseRequest;
use App\Http\Requests\UpdateLicitacionFaseRequest;
use App\Repositories\Licitacion\LicitacionRepository;
use App\Repositories\LicitacionFase\LicitacionFaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LicitacionFaseController extends Controller
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
        $this->repo = LicitacionFaseRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = LicitacionFaseRepository::GetInstance();
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
     * @param  \App\Http\Requests\StoreLicitacionFaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo = LicitacionFaseRepository::GetInstance();
        $data = $request->all();
        $data = $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LicitacionFase  $licitacionFase
     * @return \Illuminate\Http\Response
     */
    public function show(LicitacionFase $licitacionFase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LicitacionFase  $licitacionFase
     * @return \Illuminate\Http\Response
     */
    public function edit(LicitacionFase $licitacionFase)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLicitacionFaseRequest  $request
     * @param  \App\Models\LicitacionFase  $licitacionFase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LicitacionFase $licitacionFase)
    {
        $this->repo = LicitacionFaseRepository::GetInstance();
        $data = $request->all();
        $licitacionFase = $this->repo->find($data["id"]);
        $this->repo->update($licitacionFase, $data);
        $this->repo = null;
        return json_encode($licitacionFase);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LicitacionFase  $licitacionFase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $licitacionFase)
    {
        $objeto = new LicitacionFase($licitacionFase->all());
        $objeto->id = $licitacionFase->id;
        $this->repo = LicitacionFaseRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }

    public function cambiarEstado(Request $request){
        $this->repo = LicitacionFaseRepository::GetInstance();
        $licitacion_fase = $this->repo->find($request->id);
        $licitacion_fase->estado = 6;
        $licitacion_fase->save();
        
        $licitaciones_fase = $this->repo->findByParams([
            'licitacion' => $licitacion_fase->licitacion
        ]);
        $max_iterador = $licitaciones_fase->count();
        $iterador = 0;
        $encontrado = false;
        $editado = false;
        foreach($licitaciones_fase as $lf){
            if($encontrado){
                $entidadLf = $this->repo->find($lf->id);
                $entidadLf->estado = 4;
                $entidadLf->save();
                $editado = true;
                break;
            }
            if($lf->id == $request->id){
                $encontrado = true;
            }
            $iterador++;
        }
        //Si no editó la siguiente fase, entonces debe modificar la licitación
        if(!$editado){
            $this->repo = LicitacionRepository::GetInstance();
            $licitacion = $this->repo->find($licitacion_fase->licitacion);
            $licitacion->estado = 5;
            $licitacion->save();
        }
        $this->repo = null;
        return Redirect::back();
    }
}
