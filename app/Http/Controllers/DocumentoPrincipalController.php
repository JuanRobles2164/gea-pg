<?php

namespace App\Http\Controllers;

use App\Repositories\Documento\DocumentoRepository;
use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DocumentoPrincipalController extends Controller
{
    private $validationRules = [
        'data_file' => 'required',
        'tipo_documento_recurrente_constante_check' => 'required',
        'fecha_vence' => ['required']
    ];
    public function index(){
        $this->repo = DocumentoRepository::GetInstance();
        $documentos = $this->repo->getAllPrincipales();
        $allData = [
            'documentos' => $documentos,
        ];
        return view('DocumentosPrincipales.index', $allData);
    }

    public function gestion(){
        $this->repo = TipoDocumentoRepository::GetInstance();
        $tipos_documento = $this->repo->getAll();
        $allData = [
            'tipos_documento' => $tipos_documento,
        ];
        return view('DocumentosPrincipales.gestion',  $allData);
    }

    public function subirDocTemporal(Request $request){
        if($request->hasFile('data_file')){
            $file = $request->file('data_file');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->store('documentos_temporales');

            return $folder;

        }
        return "";
    }

    public function guardarDocumento(Request $request){
        $validated = $request->validate($this->validationRules);
        return $request;
        //Primero guarda el documento y luego intentará guardad la entidad
        $nombreArchivoOriginal = $request->file('data_file')->getClientOriginalName();
        $path_file = $request->file('data_file')->store('documentos_principales');
        $this->repo = DocumentoRepository::GetInstance();
        $data = $request->all();
        $data['path_file'] = $path_file;

        if($data['tipo_documento_recurrente_constante_check'] != 'Constante'){
            $data['recurrente'] = false;
            $data['constante'] = true;
        }else{
            $data['recurrente'] = true;
            $data['constante'] = false;
        }
        unset($data['tipo_documento_recurrente_constante_check']);

        if(isset($data['data_file'])){
            unset($data['data_file']);
        }
        $dataToSave = [
            'numero' => Carbon::now()->timestamp,
            'nombre' => $nombreArchivoOriginal,
            'descripcion' => isset($data['descripcion']) ? $data['descripcion'] : "N/A",
            'recurrente' => $data['recurrente'],
            'constante' => $data['constante'],
            'fecha_vencimiento' => $data['fecha_vencimiento'],
            'path_file' => $path_file,
            'estado' => 1,
            'tipo_documento' => $data['tipo_documento'],
            'created_at' => now(),
            'updated_at' => now()
        ];

        $data = $this->repo->create($dataToSave);
        $this->repo = null;
        return $this->index();
    }
}
