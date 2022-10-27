<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use App\Http\Requests\StorefaseRequest;
use App\Http\Requests\UpdatefaseRequest;
use App\Models\FaseTipoDocumento;
use App\Repositories\Fase\FaseRepository;
use App\Repositories\FaseTipoDocumento\FaseTipoDocumentoRepository;
use Illuminate\Http\Request;

class FaseController extends Controller
{
    private $validationRules = [
        'nombre' => 'required',
        'descripcion' => ['required', 'max:200']
    ];
    private $repo = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repo = FaseRepository::GetInstance();
        $lista = $this->repo->getAll();
        $this->repo = null;

        $allData = ['fases' => $lista
        ];
        return view('Fase.index', $allData);
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = FaseRepository::GetInstance();
        $lista = $this->repo->getAllEstado($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $this->repo = FaseRepository::GetInstance();
        $objeto = $this->repo->find($request->id);
        $this->repo = null;
        return json_encode($objeto);
    }

    public function detailsByTipoLic(Request $request){
        $this->repo = FaseRepository::GetInstance();
        $lista = $this->repo->obtenerFasesDocumentosByTipoLicitacion($request->tipo);
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
     * @param  \App\Http\Requests\StoreFaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules);
        $this->repo = FaseRepository::GetInstance();
        $data = $request->all();
        $retorno = [];

        $dataFase = [];
        $dataFase['nombre'] = $data['nombre'];
        $dataFase['descripcion'] = $data['descripcion'];
        $entidad = $this->repo->create($dataFase);
        $retorno['fase'] = $entidad;
        $retorno['fase_tipo_documento'] = [];
        $this->repo = null;

        $this->repo = FaseTipoDocumentoRepository::GetInstance();
        $array_num = count($data['tdocs']);
        for ($i = 0; $i < $array_num; ++$i){
            $dataFaseTipoDocumento['fase'] = $entidad->id;
            $dataFaseTipoDocumento['tipo_documento'] =  $data['tdocs'][$i]['idTDocs'];
            array_push($retorno['fase_tipo_documento'], $this->repo->create($dataFaseTipoDocumento));
        }

        return json_encode($retorno);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function show(Fase $fase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function edit(Fase $fase)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFaseRequest  $request
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fase $fase)
    {
        $validated = $request->validate($this->validationRules);
        $this->repo = FaseRepository::GetInstance();
        $data = $request->all();
        $fase = $this->repo->find($data["id"]);
        $entidad = $this->repo->update($fase, $data);
        $retorno['fase'] = $entidad;
        $retorno['fase_tipo_documento'] = [];
        $this->repo = null;

        $this->repo = FaseTipoDocumentoRepository::GetInstance();
        $faseTipoDocs = $this->repo->obtenerTiposDocsByFase($data["id"]); 
        $array_num = count($data['tdocs']);
        $tdocsModificadas = [];
        for ($i = 0; $i < $array_num; ++$i){          
            $dataFaseTipoDocumento['tipo_documento'] = $data['tdocs'][$i]['idTDocs'];
            $dataFaseTipoDocumento['fase'] = $entidad->id;    
            $dataFaseTipoDocumento['estado'] = '1';
            if($faseTipoDocs != null){
                foreach($faseTipoDocs as $ftd){
                    if($ftd->tipo_documento == $data['tdocs'][$i]['idTDocs']){     
                        array_push($tdocsModificadas,$ftd->id);            
                        break;
                    }
                }
            }
            array_push($retorno['fase_tipo_documento'],  $this->repo->updateftd($dataFaseTipoDocumento));
        }
        
        if(count($tdocsModificadas) != 0 || $array_num == 0){
            foreach($faseTipoDocs as $ftl){
                if(!(in_array($ftl->id,$tdocsModificadas))){
                    $dataFaseTipoDocumento['fase'] = $entidad->id;
                    $dataFaseTipoDocumento['tipo_documento'] = $ftl->tipo_documento;    
                    $dataFaseTipoDocumento['estado'] = '3';
                }
                array_push($retorno['fase_tipo_documento'],  $this->repo->updateftd($dataFaseTipoDocumento));
            }
        }

        $this->repo = null;
        return json_encode($retorno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $fase)
    {
        $objeto = new Fase($fase->all());
        $objeto->id = $fase->id;
        $this->repo = FaseRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }

    public function obtenerDocumentosYFasesByTipoLicitacionId(Request $request){
        $allData = [];
        $this->repo = FaseRepository::GetInstance();
        
        $fases = $this->repo->obtenerFasesDocumentosByTipoLicitacion($request->id);
        foreach($fases as $f){
            $documentos = $this->repo->obtenerDocumentosByFaseId($f->id);
            $arrTemp = [
                'fase' => $f,
                'documentos' => $documentos
            ];
            array_push($allData, $arrTemp);
        }
        $this->repo = null;
        return json_encode($allData);
    }

    public function obtenerDocumentosByFaseId(Request $request){
        $this->repo = FaseRepository::GetInstance();
        $documentos = $this->repo->obtenerDocumentosByFaseId($request->id);
        $this->repo = null;
        return json_encode($documentos);
    }

}