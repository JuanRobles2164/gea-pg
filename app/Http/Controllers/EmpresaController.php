<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Repositories\Empresa\EmpresaRepository;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    private $repo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repo = EmpresaRepository::GetInstance();
        $empresa = $this->repo->firstRecord();
        $this->repo = null;
        $allData = [
            "empresa" => $empresa
        ];
        return view('Empresa.empresa', $allData);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRepresentante()
    {
        $this->repo = EmpresaRepository::GetInstance();
        $empresa = $this->repo->firstRecord();
        $this->repo = null;
        $allData = [
            "empresa" => $empresa
        ];
        return view('Empresa.representante_legal', $allData);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->repo = EmpresaRepository::GetInstance();
        $data = $request->all();
        unset($data['id']);
        $data['logo'] = $data['data_file'];
        unset($data['data_file']);
        $data = $this->repo->create($data);
        $this->repo = null;
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        $this->repo = EmpresaRepository::GetInstance();
        $obj = $this->repo->find($empresa->id);
        $this->repo = null;

        $allData = ['empresa'=> $obj];
        return json_encode($allData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $this->repo = EmpresaRepository::GetInstance();
        $data = $request->all();
        $empresa = $this->repo->find($data["id"]);
        
        
        //Si viene de la vista del representante legal
        if($request->exists('nombre_archivo_representante_legal_firma')){
            $path = $request->data_file;
            $nombreOriginal = $request->nombre_archivo_representante_legal_firma;
            $newPath = "";
            //Si viene de la vista de la empresa (Nosotros)
            try{
                $newPath = "firmas/empresa/representante_legal/".$nombreOriginal;
                Storage::disk('local')->move($path, $newPath);
            }catch(Exception $e){

            }
            $empresa->representante_legal_firma = $newPath;
            $data['representante_legal_firma'] = $newPath;
            $data['logo'] = $empresa->logo;
            unset($data['data_file']);
            unset($data['nombre_archivo_representante_legal_firma']);

        }else{
            $path = $request->data_file;
            $nombreOriginal = $request->file_name;
            $newPath = "";
            //Si viene de la vista de la empresa (Nosotros)
            try{
                $newPath = "logos/empresa/".$nombreOriginal;
                Storage::disk('local')->move($path, $newPath);
            }catch(Exception $e){

            }
            $empresa->logo = $newPath;
            $data['logo'] = $newPath;
            $data['representante_legal_firma'] = $empresa->representante_legal_firma;
            unset($data['data_file']);
            unset($data['file_name']);
        }
        
        
        $this->repo->update($empresa, $data);
        $this->repo = null;
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
