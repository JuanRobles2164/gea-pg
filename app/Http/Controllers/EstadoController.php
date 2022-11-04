<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Repositories\Estado\EstadoRepository;
use Illuminate\Http\Request;


class EstadoController extends Controller
{
    private $repo = null;
    private $validationRules = [
        'nombre' => 'required',
        'descripcion' => ['required', 'max:50']
    ];

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        $this->repo = EstadoRepository::GetInstance();
        $lista = $this->repo->getAll();
        $this->repo = null;
        $allData = ['estados' => $lista];
        return view('Estado.index', $allData);
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = EstadoRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = EstadoRepository::GetInstance();
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
     * @param  \App\Http\Requests\StoreEstadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules);
        $this->repo = EstadoRepository::GetInstance();
        $data = $request->all();
        $data =  $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEstadoRequest  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        $validated = $request->validate($this->validationRules);
        $this->repo = EstadoRepository::GetInstance();
        $data = $request->all();
        $estado = $this->repo->find($data["id"]);
        $this->repo->update($estado, $data);
        $this->repo = null;
        return json_encode($estado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $estado)
    {
        $objeto = new Estado($estado->all());
        $objeto->id = $estado->id;
        $this->repo = EstadoRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }
}
