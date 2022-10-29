<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Repositories\Documento\DocumentoRepository;
use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Node\Block\Document;

class DocumentoPrincipalController extends Controller
{
    private $validationRules = [
        'data_file' => 'required',
        'nombre' => 'required',
        'tipo_documento' => 'required|numeric|min:1',
        'recurrente_constante' => 'required',
        'fecha_vencimiento' => ['required']
    ];
    public function index(){
        $this->repo = DocumentoRepository::GetInstance();
        $documentos = $this->repo->getAllPrincipales();
        foreach($documentos as $doc){
            $doc->numero = str_pad($doc->numero,6,"0",STR_PAD_LEFT); 
        }
        $allData = [
            'documentos' => $documentos,
        ];
        return view('DocumentosPrincipales.index', $allData);
    }

    public function toggleDocumentoState(Request $request){
        $this->repo = DocumentoRepository::GetInstance();
        $documento = $this->repo->toggleState($request->id);
        $this->repo = null;
        return json_encode($documento);
    }


    public function gestion(){
        $this->repo = TipoDocumentoRepository::GetInstance();
        $tipos_documento = $this->repo->getAll();
        $allData = [
            'tipos_documento' => $tipos_documento
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
            $data = $request->all();

            $newPathFile = "documentos_principales/".now()->timestamp."".$request->session()->get('file_name');
            Storage::disk('local')->move($request->session()->get('file_path'), $newPathFile);

            $data['path_file'] = $newPathFile;

            if($data['recurrente_constante'] != 'constante'){
                $data['recurrente'] = false;
                $data['constante'] = true;
            }else{
                $data['recurrente'] = true;
                $data['constante'] = false;
            }
            unset($data['recurrente_constante']);

            if(isset($data['data_file'])){
                unset($data['data_file']);
            }
           
            //consultar numero actual, sumarle uno y guardar en numeracion 
            $this->repo = TipoDocumentoRepository::GetInstance();
            $tipoDoc = $this->repo->find($data['tipo_documento']);
            $valor = $tipoDoc->valor_actual;
            $tipoDoc->valor_actual = $valor + 1;
            // return $tipoDoc;
            $objeto = $this->repo->find($data["tipo_documento"]);
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

            $data['numero'] = $tipoDoc->valor_actual;
            $this->repo = DocumentoRepository::GetInstance();
            $data['nombre_archivo'] = $request->session()->get('file_name');
            $dataToSave = [
                'numero' => $data['numero'],
                'nombre' => $data['nombre'],
                'nombre_archivo' => $data['nombre_archivo'],
                'descripcion' => isset($data['descripcion']) ? $data['descripcion'] : "N/A",
                'recurrente' => $data['recurrente'],
                'constante' => $data['constante'],
                'fecha_vencimiento' => Carbon::parse($data['fecha_vencimiento']),
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

    public function destroy(Request $request, Documento $documento)
    {
        $this->repo = DocumentoRepository::GetInstance();
        $data = $request->all();
        $data["estado"] = '3';
        $documento = $this->repo->find($data["id"]);
        $this->repo->update($documento, $data);
        $this->repo = null;
        return json_encode($documento);
    }
}
