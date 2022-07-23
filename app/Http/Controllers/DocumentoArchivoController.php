<?php

namespace App\Http\Controllers;

use App\Models\DocumentoArchivo;
use App\Http\Requests\StoreDocumentoArchivoRequest;
use App\Http\Requests\UpdateDocumentoArchivoRequest;
use App\Repositories\DocumentoArchivo\DocumentoArchivoRepository;
use Illuminate\Http\Request;

class DocumentoArchivoController extends Controller
{
    private $repo = null;

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = DocumentoArchivoRepository::GetInstance();
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
     * @param  \App\Http\Requests\StoreDocumentoArchivoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentoArchivoRequest $request)
    {
        $this->repo = DocumentoArchivoRepository::GetInstance();
        $data = $request->all();
        $objeto = new DocumentoArchivo($data);
        $this->repo->create($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentoArchivo  $documentoArchivo
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentoArchivo $documentoArchivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentoArchivo  $documentoArchivo
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentoArchivo $documentoArchivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentoArchivoRequest  $request
     * @param  \App\Models\DocumentoArchivo  $documentoArchivo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentoArchivoRequest $request, DocumentoArchivo $documentoArchivo)
    {
        $this->repo = DocumentoArchivoRepository::GetInstance();
        $data = $request->all();
        $this->repo->update($documentoArchivo, $data);
        $this->repo = null;
        return json_encode($documentoArchivo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentoArchivo  $documentoArchivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentoArchivo $documentoArchivo)
    {
        $this->repo = DocumentoArchivoRepository::GetInstance();
        $this->repo->delete($documentoArchivo);
        $this->repo = null;
        return json_encode($documentoArchivo);
    }
}
