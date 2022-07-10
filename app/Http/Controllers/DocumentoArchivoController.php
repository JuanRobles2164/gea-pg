<?php

namespace App\Http\Controllers;

use App\Models\DocumentoArchivo;
use App\Http\Requests\StoreDocumentoArchivoRequest;
use App\Http\Requests\UpdateDocumentoArchivoRequest;

class DocumentoArchivoController extends Controller
{
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentoArchivo  $documentoArchivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentoArchivo $documentoArchivo)
    {
        //
    }
}
