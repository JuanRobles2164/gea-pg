<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\Cliente\ClienteRepository;
use App\Repositories\Estado\EstadoRepository;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    private $repo = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repo = ClienteRepository::GetInstance();
        $lista = $this->repo->getAllEstado();
        $this->repo = null;

        $this->repo = EstadoRepository::GetInstance();
        $listaEstados = $this->repo->getAll();
        $this->repo = null;
        $allData = ['clientes' => $lista,
                    'estados' => $listaEstados
        ];
        return view('Cliente.index', $allData);
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = ClienteRepository::GetInstance();
        $lista = $this->repo->getAllEstado($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $this->repo = ClienteRepository::GetInstance();
        $obj = $this->repo->find($request->id);
        $this->repo = null;

        $allData = ['cliente'=> $obj];
        return json_encode($allData);
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
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'razon_social' => ['required'],
            'email' => ['required', 'email'],
            'direccion' => ['required', 'string', 'max:80'],
            'identificacion' => ['required', 'max:20'],
            'tipo_identificacion' => 'required',
            'telefono' => ['required']
        ]);
        $this->repo = ClienteRepository::GetInstance();
        $data = $request->all();
        $data = $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'razon_social' => ['required'],
            'email' => ['required', 'email'],
            'direccion' => ['required', 'string', 'max:80'],
            'identificacion' => ['required', 'max:20'],
            'tipo_identificacion' => 'required',
            'telefono' => ['required']
        ]);

        $this->repo = ClienteRepository::GetInstance();
        $data = $request->all();
        $cliente = $this->repo->find($data["id"]);
        $this->repo->update($cliente, $data);
        $this->repo = null;
        return json_encode($cliente);
    }

    public function toggleClienteState(Request $request){
        $this->repo = ClienteRepository::GetInstance();
        $cliente = $this->repo->toggleState($request->id);
        $this->repo = null;
        return json_encode($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cliente $cliente)
    {
        $this->repo = ClienteRepository::GetInstance();
        $data = $request->all();
        $data["estado"] = '3';
        $cliente = $this->repo->find($data["id"]);
        $this->repo->update($cliente, $data);
        $this->repo = null;
        return json_encode($cliente);
    }
}
