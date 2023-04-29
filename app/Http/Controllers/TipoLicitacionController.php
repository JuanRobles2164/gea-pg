<?php

namespace App\Http\Controllers;

use App\Models\TipoLicitacion;
use App\Http\Requests\StoreTipoLicitacionRequest;
use App\Http\Requests\UpdateTipoLicitacionRequest;
use App\Http\Util\Utilidades;
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
    public function index(Request $request)
    {
        $this->repo = TipoLicitacionRepository::GetInstance();
        $lista = $this->repo->getAllEstado();
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

    public function toggleTipoLicState(Request $request){
        $this->repo = TipoLicitacionRepository::GetInstance();
        $tipo_lic = $this->repo->toggleState($request->id);
        $this->repo = null;
        return json_encode($tipo_lic);
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
        $dataTipoLicitacion['indicativo'] = Utilidades::obtenerIndicativo(strtoupper($data['nombre']));
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
    public function update(Request $request)
    {
        $tipoLicitacion = new TipoLicitacion;

        $request->validate($this->validationRules);
        $this->repo = TipoLicitacionRepository::GetInstance();
        $data = $request->all();
        $dataTipoLicitacion = [
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'indicativo' => Utilidades::obtenerIndicativo($data['nombre'])
        ];
        $tipoLicitacion = $this->repo->find($data["id"]);
        $entidad = $this->repo->update($tipoLicitacion, $dataTipoLicitacion);

        $retorno['tipo_licitacion'] = $entidad;
        $retorno['fase_tipo_licitacion'] = [];
        $this->repo = null;
        $this->repo = FaseTipoLicitacionRepository::GetInstance();
        //Obtiene todas las fases asociadas 
        $fasestl = $this->repo->obtenerFasesTLByTipoLicitacion($data['id']);
        $array_num = count($data['fases']);
        $fasesModificadas = [];
        
        $dataResultArray = [];
        //Sea nuevo o antiguo, procesará todas las solicitudes y deberá crearlas o actualizarlas, según corresponda
        //Si viene de front->back no importa si están creadas o no, deberá iterar sobre todas y actualizarlas
        foreach($data['fases'] as $i){
            $data_tl = [
                'orden' => $i['index'],
                'fase' => $i['idFase'],
                'estado' => 1,
                'tipo_licitacion' => $entidad->id
            ];
            array_push($dataResultArray, $this->repo->updateftl($data_tl));
        }

        //Ahora, para saber cuáles eliminar, deberá verificar back->front
        //Si el registro no se encuentra en el front, lo marcará como estado = 3 (Inactivo)
        foreach($fasestl as $i){
            $encontrada = false;
            foreach($data['fases'] as $j){
                //Si lo encuentra, no la elimina
                if($j['idFase'] == $i->fase){
                    $encontrada = true;
                    break;
                }
            }
            //si no lo encuentra, deberá eliminarla
            if($encontrada == false){
                $dataFTL = [
                    'estado' => 3,
                    'fase' => $i->fase,
                    'tipo_licitacion' => $i->tipo_licitacion
                ];
                array_push($dataResultArray, $this->repo->updateftl($dataFTL));
            }
        }
        $this->repo = null;
        return json_encode($dataResultArray);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoLicitacion  $tipoLicitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->repo = TipoLicitacionRepository::GetInstance();
        $data = $request->all();
        $data["estado"] = '3';
        $tipoLic = $this->repo->find($data["id"]);
        $this->repo->update($tipoLic, $data);
        $this->repo = null;
        return json_encode($tipoLic);
    }
}
