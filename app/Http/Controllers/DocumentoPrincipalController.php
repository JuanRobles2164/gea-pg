<?php

namespace App\Http\Controllers;

use App\Repositories\Documento\DocumentoRepository;
use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoPrincipalController extends Controller
{
    private $validationRules = [
        'data_file' => 'required',
        'tipo_documento_recurrente_constante_check' => 'required',
        'fecha_vencimiento' => ['required']
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
            $file_path = Storage::disk('local')->put('documentos_temporales/', $file);
            $request->session()->put('file_path', $file_path);
            $request->session()->put('file_name', $filename);
            return $file_path;
        }
        return "";
    }

    public function guardarDocumento(Request $request){
        $validated = $request->validate($this->validationRules);
        //Primero obtendrá el documento guardado en la ruta temporal y si existe, entonces cargó el doc.
        //Sino existe, entonces no subió un documento
        if($request->session()->exists('file_path')){
            $this->repo = DocumentoRepository::GetInstance();
            $data = $request->all();

            $newPathFile = "documentos_principales/".now()->timestamp."".$request->session()->get('file_name');
            Storage::disk('local')->move($request->session()->get('file_path'), $newPathFile);

            $data['path_file'] = $newPathFile;
            $data['nombre'] = $request->session()->get('file_name');

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
                'nombre' => $data['nombre'],
                'descripcion' => isset($data['descripcion']) ? $data['descripcion'] : "N/A",
                'recurrente' => $data['recurrente'],
                'constante' => $data['constante'],
                'fecha_vencimiento' => $data['fecha_vencimiento'],
                'path_file' => $data['path_file'],
                'estado' => 1,
                'tipo_documento' => $data['tipo_documento'],
                'created_at' => now(),
                'updated_at' => now()
            ];

            $data = $this->repo->create($dataToSave);
            $this->repo = null;
            return redirect(route('documento_principal.index'));
        }
        return redirect(route('documento_principal.gestion'));
    }
}
