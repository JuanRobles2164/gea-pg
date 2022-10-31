<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Http\Requests\StoreDocumentoRequest;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Repositories\Documento\DocumentoRepository;
use App\Repositories\DocumentoLicitacion\DocumentoLicitacionRepository;
use App\Repositories\LicitacionFase\LicitacionFaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class DocumentoController extends Controller
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
        $this->repo = DocumentoRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = DocumentoRepository::GetInstance();
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
     * @param  \App\Http\Requests\StoreDocumentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'data_file' => ['required'],
            'tipo_documento' => ['required']
        ]);

        $this->repo = DocumentoRepository::GetInstance();
        $data = $request->all();
        $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentoRequest  $request
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        $this->repo = DocumentoRepository::GetInstance();
        $data = $request->all();
        $documento = $this->repo->find($data["id"]);
        $this->repo->update($documento, $data);
        $this->repo = null;
        return json_encode($documento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $documento)
    {
        $objeto = new Documento($documento->all());
        $objeto->id = $documento->id;
        $this->repo = DocumentoRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }

    public function storeInComponent(Request $request){
        $validated = $request->validate([
            'data_file' => ['required'],
            'nombre_archivo' => ['required'],
            'fase_licitacion' => ['required'],
            'tipo_documento' => ['required']
        ]);
        //Mover el archivo
        $final_path = "documentos_licitaciones/".now()->timestamp.$request->nombre_archivo;
        Storage::disk('local')->move($request->data_file, $final_path);
        //Crear el archivo
        $documentoData = [
            'numero' => now()->timestamp,
            'nombre' => $request->nombre,
            'nombre_archivo' => $request->nombre_archivo,
            'path_file' => $final_path,
            'estado' => 1,
            'tipo_documento' => $request->tipo_documento,
            'created_at' => now(),
            'updated_at' => now()
        ];

        $this->repo = DocumentoRepository::GetInstance();
        $documentoEntidad = $this->repo->create($documentoData);
        $this->repo = LicitacionFaseRepository::GetInstance();
        $documentoLicitacionArr = [
            'documento' => $documentoEntidad->id,
            'licitacion_fase' => $request->fase_licitacion,
            'revisado' => true,
            'estado' => 1,
        ];
        $this->repo = DocumentoLicitacionRepository::GetInstance();
        $this->repo->create($documentoLicitacionArr);
        $this->repo = null;
        return Redirect::back();
    }

    //Aún falta terminar la funcionalidad
    public function reemplazarDocumento(Request $request){
        $data = $request->all();
        $this->repo = DocumentoRepository::GetInstance();
        //obtiene el documento actualmente asociado
        $documento = $this->repo->find($data['documento']);
        $pathFileTemporal = $data['data_file'];
        $newPathFile = "documentos_licitacion/".now()->timestamp.$documento->nombre_archivo;
        //Mueve el nuevo documento
        Storage::move($pathFileTemporal, $newPathFile);
        //Construye el nuevo objeto con los viejos datos del documento asociado
        $nuevaDataDocumento = [
            'numero' => now()->timestamp,
            //Meter la funcionalidad del número acá
            'nombre' => $documento->nombre,
            'nombre_archivo' => $documento->nombre_archivo,
            'descripcion' => $documento->descripcion,
            'recurrente' => $documento->recurrente,
            'constante' => $documento->constante,
            'fecha_vencimiento' => $documento->fecha_vencimiento,
            'data_file' => $documento->data_file,
            'path_file' => $newPathFile,
            'estado' => $documento->estado,
            'tipo_documento' => $documento->tipo_documento,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $nuevoDocumento = $this->repo->create($nuevaDataDocumento);
        $this->repo = DocumentoLicitacionRepository::GetInstance();
        $documentoLicitacion = $this->repo->findByParams([
            'registro_unico' => true,
            'licitacion_fase' => $data['fase_licitacion'],
            'documento' => $data['documento']
        ]);
        $documentoLicitacion->documento = $nuevoDocumento->id;
        $documentoLicitacion->save();
        $this->repo = null;
        return Redirect::back();
    }

    //Elimina el documento asociado a una licitación, pero no elimina el documento
    public function eliminarDocumentoLicitacion(Request $request){
        $data = $request->all();
        $this->repo = DocumentoLicitacionRepository::GetInstance();
        $documentoLicitacion = $this->repo->findByParams([
            'registro_unico' => true,
            'licitacion_fase' => $data['fase_licitacion'],
            'documento' => $data['documento']
        ]);
        //Cambiar el estado a eliminado, pero sólo en la asociación del documento
        $documentoLicitacion->estado = 3;
        $documentoLicitacion->save();
        return Redirect::back();
    }
}
