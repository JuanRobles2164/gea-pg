<?php

namespace App\Http\Controllers;

use App\Models\DocumentoLicitacion;
use App\Http\Requests\StoreDocumentoLicitacionRequest;
use App\Http\Requests\UpdateDocumentoLicitacionRequest;
use App\Repositories\DocumentoLicitacion\DocumentoLicitacionRepository;
use Illuminate\Http\Request;


class DocumentoLicitacionController extends Controller
{
    private $validationRules = [
        'documento' => 'required',
        'licitacion_fase' => 'required',
        'clonado' => 'required'
    ];
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
        $this->repo = DocumentoLicitacionRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = DocumentoLicitacionRepository::GetInstance();
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
     * @param  \App\Http\Requests\StoreDocumentoLicitacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules);
        $this->repo = DocumentoLicitacionRepository::GetInstance();
        $data = $request->all();
        $data = $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentoLicitacion  $documentoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentoLicitacion $documentoLicitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentoLicitacion  $documentoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentoLicitacion $documentoLicitacion)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentoLicitacionRequest  $request
     * @param  \App\Models\DocumentoLicitacion  $documentoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentoLicitacion $documentoLicitacion)
    {
        $validated = $request->validate($this->validationRules);
        $this->repo = DocumentoLicitacionRepository::GetInstance();
        $data = $request->all();
        $documentoLicitacion = $this->repo->find($data["id"]);
        $this->repo->update($documentoLicitacion, $data);
        $this->repo = null;
        return json_encode($documentoLicitacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentoLicitacion  $documentoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $documentoLicitacion)
    {
        $objeto = new DocumentoLicitacion($documentoLicitacion->all());
        $objeto->id = $documentoLicitacion->id;
        $this->repo = DocumentoLicitacionRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }
    
}
