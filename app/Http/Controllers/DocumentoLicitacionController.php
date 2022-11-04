<?php

namespace App\Http\Controllers;

use App\Models\DocumentoLicitacion;
use App\Repositories\DocumentoLicitacion\DocumentoLicitacionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function asociarDocumentosFromComponent(Request $request){
        $data = $request->all();
        $dfmfJsons = [];
        $this->repo = DocumentoLicitacionRepository::GetInstance();
        foreach($data['documentoFromModalFases'] as $dfmf){
            $objetoJson = json_decode($dfmf);
            $documentoLicitacion = $this->repo->findByParamsWithOutState([
                'registro_unico' => true,
                'documento' => $objetoJson->id,
                'licitacion_fase' => $data['licitacion_fase']
            ]);
            if($documentoLicitacion == null){
                //si no encontró ningún registro, deberá crearlo
                $retorno = $this->repo->create([
                    'documento' => $objetoJson->id,
                    'licitacion_fase' => $data['licitacion_fase'],
                    'revisado' => true,
                    'estado' => 1
                ]);
            }else{
                //si encontró algún registro, deberá actualizar el estado a 1 (Activo)
                $documentoLicitacion->estado = 1;
                $documentoLicitacion->save();
            }
        }
        $this->repo = null;
        return Redirect::back();
    }
    
}
