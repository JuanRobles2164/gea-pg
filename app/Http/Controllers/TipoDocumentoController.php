<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use App\Http\Requests\StoreTipoDocumentoRequest;
use App\Http\Requests\UpdateTipoDocumentoRequest;
use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Illuminate\Http\Request;
use App\Http\Util\Utilidades;

class TipoDocumentoController extends Controller
{
    private $validationRules = [
        'nombre' => 'required',
        'descripcion' => 'required'
    ];
    private $repo = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repo = TipoDocumentoRepository::GetInstance();
        $lista = $this->repo->getAllEstado();
        $this->repo = null;
        $allData = ['tipos_documento' => $lista];
        return view('TipoDocumento.index', $allData);
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = TipoDocumentoRepository::GetInstance();
        $lista = $this->repo->getAllEstado($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = TipoDocumentoRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function find(Request $request){
        $this->repo = TipoDocumentoRepository::GetInstance();
        $modelo = $this->repo->find($request->id);
        return json_encode($modelo);
    }

    public function detailsbyfase(Request $request){
        $this->repo = TipoDocumentoRepository::GetInstance();
        $lista = $this->repo->obtenerTipoDocumentosByFase($request->fase);
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
     * @param  \App\Http\Requests\StoreTipoDocumentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);
        $this->repo = TipoDocumentoRepository::GetInstance();
        $data = $request->all();
        $data['indicativo'] = Utilidades::obtenerInicial(strtoupper($data['nombre']));
        $data = $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function show(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoDocumento $tipoDocumento)
    {
       //
    }

    public function toggleTipoDocState(Request $request){
        $request->validate($this->validationRules);
        $this->repo = TipoDocumentoRepository::GetInstance();
        $cliente = $this->repo->toggleState($request->id);
        $this->repo = null;
        return json_encode($cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoDocumentoRequest  $request
     * @param  \App\Models\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoDocumento $tipoDocumento)
    {
        $this->repo = TipoDocumentoRepository::GetInstance();
        $data = $request->all();
        $tipoDocumento = $this->repo->find($data["id"]);
        $data['indicativo'] = Utilidades::obtenerInicial(strtoupper($data['nombre']));
        $this->repo->update($tipoDocumento, $data);
        $this->repo = null;
        return json_encode($tipoDocumento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipoDocumento $tipoDocumento)
    {
        $this->repo = TipoDocumentoRepository::GetInstance();
        $data = $request->all();
        $data["estado"] = '3';
        $tipoDocumento = $this->repo->find($data["id"]);
        $this->repo->update($tipoDocumento, $data);
        $this->repo = null;
        return json_encode($tipoDocumento);
    }
}