<?php

namespace App\Http\Controllers;

use App\Models\TipoLicitacion;
use App\Http\Requests\StoreTipoLicitacionRequest;
use App\Http\Requests\UpdateTipoLicitacionRequest;
use App\Models\FaseTipoLicitacion;
use App\Repositories\FaseTipoLicitacion\FaseTipoLicitacionRepository;
use App\Repositories\TipoLicitacion\TipoLicitacionRepository;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class TipoLicitacionController extends Controller
{
    private $validationRules = [
        'nombre' => 'required',
        'descripcion' => 'required',
    ];
    private $repo = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repo = TipoLicitacionRepository::GetInstance();
        $lista = $this->repo->getAll();
        $this->repo = null;

        $allData = ['tipos_licitacion' => $lista,
        ];
        return view('TipoLicitacion.index', $allData);
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = TipoLicitacionRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $this->repo = TipoLicitacionRepository::GetInstance();
        $objeto = $this->repo->find($request->id);
        $this->repo = null;
        return json_encode($objeto);
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
     * @param  \App\Http\Requests\StoreTipoLicitacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);
        $this->repo = TipoLicitacionRepository::GetInstance();
        $data = $request->all();
        $retorno = [];

        $dataTipoLicitacion = [];
        $dataTipoLicitacion['nombre'] = $data['nombre'];
        $dataTipoLicitacion['descripcion'] = $data['descripcion'];
        $entidad = $this->repo->create($dataTipoLicitacion);
        $retorno['tipo_licitacion'] = $entidad;
        $retorno['fase_tipo_licitacion'] = [];
        $this->repo = null;

        $this->repo = FaseTipoLicitacionRepository::GetInstance();
        
        $array_num = count($data['fases']);
        for ($i = 0; $i < $array_num; ++$i){
            $dataFaseTipoLicitacion['orden'] = $data['fases'][$i]['index'];
            $dataFaseTipoLicitacion['fase'] = $data['fases'][$i]['idFase'];
            $dataFaseTipoLicitacion['tipo_licitacion'] = $entidad->id;
            array_push($retorno['fase_tipo_licitacion'], $this->repo->create($dataFaseTipoLicitacion));
        }
        return json_encode($retorno);
    }

    
    public function storeInView(Request $request)
    {
        // $request->validate($this->validationRules);
        // $this->repo = TipoLicitacionRepository::GetInstance();
        // $data = $request->all();
        // $retorno = [];

        // $dataTipoLicitacion = [];
        // $dataTipoLicitacion['nombre'] = $data['nombre'];
        // $dataTipoLicitacion['descripcion'] = $data['descripcion'];
        // $entidad = $this->repo->create($dataTipoLicitacion);
        // $retorno['tipo_licitacion'] = $entidad;
        // $retorno['fase_tipo_licitacion'] = [];
        // $this->repo = null;

        // $this->repo = FaseTipoLicitacionRepository::GetInstance();
        
        // foreach ($data['fases'] as $fase) {
        //     $dataFaseTipoLicitacion['orden'] = $fase->index;
        //     $dataFaseTipoLicitacion['fase'] = $fase->idFase;
        //     $dataFaseTipoLicitacion['tipo_licitacion'] = $entidad->id;
        //     array_push($retorno['fase_tipo_licitacion'], $this->repo->create($dataFaseTipoLicitacion));
        // }
        // return json_encode($retorno);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoLicitacion  $tipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function show(TipoLicitacion $tipoLicitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoLicitacion  $tipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoLicitacion $tipoLicitacion)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoLicitacionRequest  $request
     * @param  \App\Models\TipoLicitacion  $tipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoLicitacion $tipoLicitacion)
    {
        $request->validate($this->validationRules);
        $this->repo = TipoLicitacionRepository::GetInstance();
        $data = $request->all();
        $dataTipoLicitacion = [];
        $dataTipoLicitacion['nombre'] = $data['nombre'];
        $dataTipoLicitacion['descripcion'] = $data['descripcion'];
        $tipoLicitacion = $this->repo->find($data["id"]);
        $entidad = $this->repo->update($tipoLicitacion, $dataTipoLicitacion);
        $retorno['tipo_licitacion'] = $entidad;
        $retorno['fase_tipo_licitacion'] = [];
        $this->repo = null;

        $this->repo = FaseTipoLicitacionRepository::GetInstance();
        $fasestl = $this->repo->obtenerFasesTLByTipoLicitacion($data["id"]);
        $array_num = count($data['fases']);
        $fasesModificadas = [];
        for ($i = 0; $i < $array_num; ++$i){          
            $dataFaseTipoLicitacion['orden'] = $data['fases'][$i]['index'];
            $dataFaseTipoLicitacion['fase'] = $data['fases'][$i]['idFase'];
            $dataFaseTipoLicitacion['tipo_licitacion'] = $entidad->id;    
            if($fasestl != null){
                foreach($fasestl as $ftl){
                    if($ftl->fase == $data['fases'][$i]['idFase']){     
                        array_push($fasesModificadas,$ftl->id);            
                        break;
                    }
                }
            }
            array_push($retorno['fase_tipo_licitacion'],  $this->repo->updateftl($dataFaseTipoLicitacion));
        }

        if(count($fasesModificadas) != 0 || $array_num == 0){
            foreach($fasestl as $ftl){
                if(!(in_array($ftl->id,$fasesModificadas))){
                    $dataFaseTipoLicitacion['fase'] = $ftl->fase;
                    $dataFaseTipoLicitacion['tipo_licitacion'] = $entidad->id;    
                    $dataFaseTipoLicitacion['estado'] = '3';
                }
                array_push($retorno['fase_tipo_licitacion'],  $this->repo->updateftl($dataFaseTipoLicitacion));
            }
        }

        $this->repo = null;
        return json_encode($retorno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoLicitacion  $tipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $tipoLicitacion)
    {
        $objeto = new TipoLicitacion($tipoLicitacion->all());
        $objeto->id = $tipoLicitacion->id;
        $this->repo = TipoLicitacionRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }
}
