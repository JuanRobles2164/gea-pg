<?php

namespace App\Http\Controllers;

use App\Models\DocumentoCategoria;
use App\Repositories\DocumentoCategoria\DocumentoCategoriaRepository;
use Illuminate\Http\Request;

class DocumentoCategoriaController extends Controller
{
    private $repo = null;

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = DocumentoCategoriaRepository::GetInstance();
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
     * @param  \App\Http\Requests\StoreDocumentoCategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo = DocumentoCategoriaRepository::GetInstance();
        $data = $request->all();
        $objeto = new DocumentoCategoria($data);
        $this->repo->create($objeto);
        $this->repo = null;
        return json_encode($objeto);
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
    public function update(Request $request, DocumentoCategoria $documentoCategoria)
    {
        $this->repo = DocumentoCategoriaRepository::GetInstance();
        $data = $request->all();
        $this->repo->update($documentoCategoria, $data);
        $this->repo = null;
        return json_encode($documentoCategoria);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentoCategoria  $documentoCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentoCategoria $documentoCategoria)
    {
        $this->repo = DocumentoCategoriaRepository::GetInstance();
        $this->repo->delete($documentoCategoria);
        $this->repo = null;
        return json_encode($documentoCategoria);
    }
}
