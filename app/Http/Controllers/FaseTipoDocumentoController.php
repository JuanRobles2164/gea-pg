<?php

namespace App\Http\Controllers;

use App\Models\FaseTipoDocumento;
use App\Http\Requests\StoreFaseTipoDocumentoRequest;
use App\Http\Requests\UpdateFaseTipoDocumentoRequest;
use App\Repositories\FaseTipoDocumento\FaseTipoDocumentoRepository;
use Illuminate\Http\Request;

class FaseTipoDocumentoController extends Controller
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
        $this->repo = FaseTipoDocumentoRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = FaseTipoDocumentoRepository::GetInstance();
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
     * @param  \App\Http\Requests\StoreFaseTipoDocumentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo = FaseTipoDocumentoRepository::GetInstance();
        $data = $request->all();
        $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    public function storeAll(Request $request){
        //Setea el array
        $this->repo = FaseTipoDocumentoRepository::GetInstance();

        $fase_tipo_documentos = $request->fase_tipo_documentos;
        $allResponse = [];
        for($i = 0; $i < count($fase_tipo_documentos); $i++){
            $data = [
                'tipo_documento' => $fase_tipo_documentos->tipo_documento,
                'fase' => $fase_tipo_documentos->fase
            ];
            array_push($allResponse, $this->repo->create($data));
        }
        return json_encode($allResponse);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FaseTipoDocumento  $faseTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function show(FaseTipoDocumento $faseTipoDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaseTipoDocumento  $faseTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function edit(FaseTipoDocumento $faseTipoDocumento)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFaseTipoDocumentoRequest  $request
     * @param  \App\Models\FaseTipoDocumento  $faseTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FaseTipoDocumento $faseTipoDocumento)
    {
        $this->repo = FaseTipoDocumentoRepository::GetInstance();
        $data = $request->all();
        $faseTipoDocumento = $this->repo->find($data["id"]);
        $this->repo->update($faseTipoDocumento, $data);
        $this->repo = null;
        return json_encode($faseTipoDocumento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaseTipoDocumento  $faseTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $faseTipoDocumento)
    {
        $objeto = new FaseTipoDocumento($faseTipoDocumento->all());
        $objeto->id = $faseTipoDocumento->id;
        $this->repo = FaseTipoDocumentoRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }
}
