<?php

namespace App\Http\Controllers;

use App\Models\DocumentoCategoria;
use App\Http\Requests\StoreDocumentoCategoriaRequest;
use App\Http\Requests\UpdateDocumentoCategoriaRequest;

class DocumentoCategoriaController extends Controller
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
     * @param  \App\Http\Requests\StoreDocumentoCategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentoCategoriaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentoCategoria  $documentoCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentoCategoria $documentoCategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentoCategoria  $documentoCategoria
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentoCategoria $documentoCategoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentoCategoriaRequest  $request
     * @param  \App\Models\DocumentoCategoria  $documentoCategoria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentoCategoriaRequest $request, DocumentoCategoria $documentoCategoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentoCategoria  $documentoCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentoCategoria $documentoCategoria)
    {
        //
    }
}
