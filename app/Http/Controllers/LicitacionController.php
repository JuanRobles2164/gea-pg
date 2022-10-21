<?php

namespace App\Http\Controllers;

use App\Models\Licitacion;
use App\Http\Requests\StoreLicitacionRequest;
use App\Http\Requests\UpdateLicitacionRequest;
use App\Repositories\Categoria\CategoriaRepository;
use App\Repositories\Cliente\ClienteRepository;
use App\Repositories\Fase\FaseRepository;
use App\Repositories\Licitacion\LicitacionRepository;
use App\Repositories\TipoLicitacion\TipoLicitacionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LicitacionController extends Controller
{
    private $validationRules = [
        'numero' => 'required',
        'nombre' => 'required',
        'descripcion' => 'required',
        'fecha_inicio' => ['required'],
        'fecha_fin' => ['required'],
        'cliente' => 'required',
        'tipo_licitacion' => 'required',
        'categoria' => 'required'
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
            $allData = ['licitaciones' => $lista, 'categoria' => $request->categoria];
        }else{
            $lista = $this->repo->getAllEstado();
            $allData = ['licitaciones' => $lista];
        }
        $this->repo = null;
        //return json_encode($allData);
        return view('Licitacion.index', $allData);
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = LicitacionRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = LicitacionRepository::GetInstance();
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
        $this->repo = ClienteRepository::GetInstance();
        $listaClientes = $this->repo->getAllActivos();
        $this->repo = null;
        $this->repo = TipoLicitacionRepository::GetInstance();
        $listaTiposLicitaciones = $this->repo->getAllActivos();
        $this->repo = null;
        $this->repo = CategoriaRepository::GetInstance();
        $listaCategorias = $this->repo->getAllActivos();
        $numeroDocumento = Carbon::now()->getTimestamp();
        $allData = [
            'clientes' => $listaClientes, 
            'tiposLics' => $listaTiposLicitaciones, 
            'categorias' => $listaCategorias,
            'numero_documento' => $numeroDocumento,
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
        $validated = $request->validate($this->validationRules);
        //return $request;
        $data = $request->all();
        $data['fecha_inicio'] = new Carbon ($data['fecha_inicio']);
        if(isset($data['fecha_fin'])){
            $data['fecha_fin'] = new Carbon($data['fecha_fin']);
        }
        
        $this->repo = LicitacionRepository::GetInstance();
        $this->repo->create($data);
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
    public function destroy(Request $licitacion)
    {
        $objeto = new Licitacion($licitacion->all());
        $objeto->id = $licitacion->id;
        $this->repo = LicitacionRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }
}
