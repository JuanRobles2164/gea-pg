<?php

namespace App\Http\Controllers;

use App\Models\Licitacion;
use App\Http\Requests\StoreLicitacionRequest;
use App\Http\Requests\UpdateLicitacionRequest;
use App\Repositories\Categoria\CategoriaRepository;
use App\Repositories\Cliente\ClienteRepository;
use App\Repositories\Documento\DocumentoRepository;
use App\Repositories\DocumentoLicitacion\DocumentoLicitacionRepository;
use App\Repositories\Fase\FaseRepository;
use App\Repositories\FaseTipoLicitacion\FaseTipoLicitacionRepository;
use App\Repositories\Licitacion\LicitacionRepository;
use App\Repositories\LicitacionFase\LicitacionFaseRepository;
use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use App\Repositories\TipoLicitacion\TipoLicitacionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\DateTime;

class LicitacionController extends Controller
{
    private $validationRules = [
        'numero' => 'required',
        'nombre' => 'required',
        'descripcion' => 'required',
        'fecha_inicio' => ['required'],
        'fecha_fin' => ['required'],
        'cliente' => ['required', 'exists:cliente,id'],
        'tipo_licitacion' => ['required', 'exists:tipo_licitacion,id'],
        'categoria' => ['required', 'exists:categoria,id']
    ];
    private $repo = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->repo = LicitacionRepository::GetInstance();
        $lista = null;
        $allData = [];
        if(isset($request->categoria)){
            $lista = $this->repo->getAllEstadosCategoria($request->categoria);
            foreach($lista as $l){
                $l->numero = str_pad($l->numero,6,"0",STR_PAD_LEFT); 
                $datetime1 = new DateTime($l->fecha_inicio);
                $datetime2 = new DateTime($l->fecha_fin);
                $interval = $datetime1->diff($datetime2);
                $l->duracion = $interval->y . " años, " . $interval->m." meses y ".$interval->d." dias"; 
            }
            $allData = ['licitaciones' => $lista, 'categoria' => $request->categoria];
        }else{
            $lista = $this->repo->getAllEstado();
            foreach($lista as $l){
                $l->numero = str_pad($l->numero,6,"0",STR_PAD_LEFT); 
                $datetime1 = new DateTime($l->fecha_inicio);
                $datetime2 = new DateTime($l->fecha_fin);
                $interval = $datetime1->diff($datetime2);
                $l->duracion = $interval->y . " años, " . $interval->m." meses y ".$interval->d." dias"; 
            }
            $allData = ['licitaciones' => $lista];
        }
        $this->repo = null;
        //return json_encode($allData);
        return view('Licitacion.index', $allData);
    }

    public function gestionDocumentosIndex(Request $request){
        $this->repo = LicitacionRepository::GetInstance();
        $obj = $this->repo->find($request->id);

        $this->repo = LicitacionFaseRepository::GetInstance();
        $fases = $this->repo->findByParams([
            'licitacion' => $obj->id,
        ]);
        $this->repo = null;

        $allData = ['licitacion' => $obj, 'fases' => $fases];
        return view('Licitacion.gestion_documentos', $allData);
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = LicitacionRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $this->repo = LicitacionRepository::GetInstance();
        $modelo = $this->repo->find($request->id);
        $this->repo = null;
        return json_encode($modelo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->repo = ClienteRepository::GetInstance();
        $listaClientes = $this->repo->getAllActivos();
        $this->repo = null;
        $this->repo = TipoLicitacionRepository::GetInstance();
        $listaTiposLicitaciones = $this->repo->getAllActivos();
        $this->repo = null;
        $this->repo = CategoriaRepository::GetInstance();
        $listaCategorias = $this->repo->getAllActivos();
        $allData = [
            'clientes' => $listaClientes, 
            'tiposLics' => $listaTiposLicitaciones, 
            'categorias' => $listaCategorias
        ];
        return view('Licitacion.crear', $allData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLicitacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules);
        $this->repo = CategoriaRepository::GetInstance();
        //Intentará buscar primero un registro de Categoria que concuerde con el nombre, si no lo encuentra, lo creará
        $categoria = $this->repo->firstOrCreate([
            'nombre' => $request->categoria
        ]);
        $this->repo = null;




        $this->repo = LicitacionRepository::GetInstance();
        $data = $request->all();
        $data["categoria"] = $categoria->id;

        $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    public function storeInView(Request $request)
    {
        $data = $request->all();
        //consultar numero actual, sumarle uno y guardar en numeracion 
        $this->repo = TipoLicitacionRepository::GetInstance();
        $tipoLic = $this->repo->find($data['tipo_licitacion']);
        $valor = $tipoLic->valor_actual;
        $tipoLic->valor_actual = $valor + 1;
        // return $tipoDoc;
        $objeto = $this->repo->find($data["tipo_licitacion"]);
        $tipoLicArr = [
            'valor_actual' => $tipoLic->valor_actual,
            'nombre' => $tipoLic->nombre,
            'descripcion' => $tipoLic->descripcion,
            'indicativo' => $tipoLic->indicativo,
            "estado" => 1,
            "updated_at" => now()
        ];

        $this->repo->update($objeto, $tipoLicArr);
        $this->repo = null;
        //$validated = $request->validate($this->validationRules);
        $data['numero'] = $tipoLic->valor_actual;
        $copiaDocsAsociados = [];
        foreach($data['documentosAsociadosFases'] as $doc){
            array_push($copiaDocsAsociados, json_decode($doc));
        }
        $data['documentosAsociadosFases'] = $copiaDocsAsociados;
        $data['fecha_inicio'] = new Carbon ($data['fecha_inicio']);
        if(isset($data['fecha_fin'])){
            $data['fecha_fin'] = new Carbon($data['fecha_fin']);
        }
        $dataLicitacion = [
            'numero' => $data['numero'],
            "nombre" => $data['nombre'],
            "descripcion" => $data['descripcion'],
            'fecha_inicio' => $data['fecha_inicio'],
            'fecha_fin' => $data['fecha_fin'],
            'observacion' => isset($data['observacion']) ? $data['observacion'] : null,
            'estado' => 4,
            'cliente' => $data['cliente'],
            'categoria' => $data['categoria'],
            'tipo_licitacion' => $data['tipo_licitacion'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        //Paso 1: Crear la licitación.
        $this->repo = LicitacionRepository::GetInstance();
        $objetoLicitacion = $this->repo->create($dataLicitacion);

        //Paso 2: Qué fases están asociadas al tipo de licitacion? y asociar estas fases en la tabla licitacion_fase.
        $this->repo = FaseTipoLicitacionRepository::GetInstance();
        $fasesTipoLicitacion = $this->repo->obtenerFasesTLByTipoLicitacion($objetoLicitacion->tipo_licitacion);

        $licitacionFases = [];
        $iterador = 0;
        $this->repo = LicitacionFaseRepository::GetInstance();
        foreach($fasesTipoLicitacion as $ftl){
            $datosLicitacionFases = [];
            if($iterador == 0) {
                $datosLicitacionFases = [
                    'fase' => $ftl->fase,
                    'licitacion' => $objetoLicitacion->id,
                    //Estado -> En desarrollo
                    'estado' => 4,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }else{
                $datosLicitacionFases = [
                    'fase' => $ftl->fase,
                    'licitacion' => $objetoLicitacion->id,
                    //Estado -> En desarrollo
                    'estado' => 6,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            $objetoLicitacionFase = $this->repo->create($datosLicitacionFases);
            array_push($licitacionFases, $objetoLicitacionFase);
            $iterador++;
        }

        //Paso 3: Crear el documento a aquellos que no estén creados.
        $documentosAsociadosFases = $data['documentosAsociadosFases'];
        $documentosAsociadosLicitacion = [];
        $documentosLicitacionArr = [];
        foreach($documentosAsociadosFases as $daf){
            $documentoObjetoTemporal = null;
            //Si es un documento nuevo, debe crearlo
            if(isset($daf->tipo_documento)){
                $this->repo = TipoDocumentoRepository::GetInstance();
                $tipoDoc = $this->repo->find($daf->tipo_documento);
                $valor = $tipoDoc->valor_actual;
                $tipoDoc->valor_actual = $valor + 1;
                $objeto = $this->repo->find($daf->tipo_documento);
                $tipoDocArr = [
                    'valor_actual' => $tipoDoc->valor_actual,
                    'nombre' => $tipoDoc->nombre,
                    'descripcion' => $tipoDoc->descripcion,
                    'indicativo' => $tipoDoc->indicativo,
                    "estado" => 1,
                    "updated_at" => now()
                ];
    
                $this->repo->update($objeto, $tipoDocArr);
                $this->repo = null;
    
                $daf->numero = $tipoDoc->valor_actual;
                $arrayDatos = [
                    'numero' => $daf->numero,
                    'nombre' => $daf->documento_nombre,
                    'nombre_archivo' => $daf->path_file,
                    'path_file' => $daf->path_file,
                    'estado' => 1,
                    'tipo_documento' => $daf->tipo_documento,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                $cadenaBuscar = "documentos_temporales//";
                $whatIWant = substr($daf->path_file, strpos($daf->path_file, $cadenaBuscar)+1);
                $extension = substr(".", strpos($daf->path_file, "."));
                $newPathFile = "documentos_licitaciones/".now()->timestamp."".$whatIWant.$extension;
                Storage::disk('local')->move($daf->path_file, $newPathFile);

                $this->repo = DocumentoRepository::GetInstance();
                $documentoObjetoTemporal = $this->repo->create($arrayDatos);
            }else{
                $this->repo = DocumentoRepository::GetInstance();
                $documentoObjetoTemporal = $this->repo->find($daf->id);
            }
            //Construye los objetos de la tabla Documento_licitacion
            foreach($licitacionFases as $lf){
                //Paso 4: Asociar todo, tanto los asociados como los recién creados.
                if($lf->fase == $daf->fase){
                    $this->repo = DocumentoLicitacionRepository::GetInstance();
                    $dataDocLic = [
                        'documento' => $documentoObjetoTemporal->id,
                        'licitacion_fase' => $lf->id,
                        'revisado' => true,
                        'estado' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    array_push($documentosLicitacionArr, $this->repo->create($dataDocLic));
                    break;
                }
            }
            array_push($documentosAsociadosLicitacion, $documentoObjetoTemporal);
        }
        $this->repo = null;
        return redirect(route('licitacion.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function show(Licitacion $licitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->repo = LicitacionRepository::GetInstance();
        $obj = $this->repo->find($request->id);
        $this->repo = null;

        $this->repo = FaseRepository::GetInstance();
        $fases = $this->repo->findByParams($request->tipo_licitacion);

        $allData = ['licitacion' => $obj, 'fases' => $fases];
        return view('Licitacion.edit', $allData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLicitacionRequest  $request
     * @param  \App\Models\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Licitacion $licitacion)
    {
        $validated = $request->validate($this->validationRules);
        
        $this->repo = LicitacionRepository::GetInstance();
        $data = $request->all();
        $licitacion = $this->repo->find($data["id"]);
        $this->repo->update($licitacion, $data);
        $this->repo = null;
        return json_encode($licitacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,  Licitacion $licitacion)
    {
        $this->repo = LicitacionRepository::GetInstance();
        $data = $request->all();
        $data["estado"] = '3';
        $licitacion = $this->repo->find($data["id"]);
        $this->repo->update($licitacion, $data);
        $this->repo = null;
        return json_encode($licitacion);
    }
}
