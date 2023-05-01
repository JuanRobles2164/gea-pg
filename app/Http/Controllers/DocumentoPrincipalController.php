<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Repositories\Documento\DocumentoRepository;
use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use App\Rules\VerificarFechaMayorHoy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoPrincipalController extends Controller
{
    private $repo;
    private $validationRules = [
        'data_file' => 'required',
        'nombre' => 'required',
        'tipo_documento' => 'required|numeric|min:1',
        'recurrente_constante' => 'required',
        'fecha_vencimiento' => ['exclude_unless:recurrente_constante,recurrente|required|date|after_or_equal:tomorrow']
    ];
    private $validationRulesEdit = [
        'nombre' => 'required',
        'tipo_documento' => 'required|numeric|min:1',
        'recurrente_constante' => 'required',
        'fecha_vencimiento' => ['exclude_unless:recurrente_constante,recurrente|required|date|after_or_equal:tomorrow']
    ];
    public function index(Request $request){
        $this->repo = DocumentoRepository::GetInstance();
        $documentos = $this->repo->listarDocumentosMaestros();
        foreach($documentos as $doc){
            $doc->numero = str_pad($doc->numero, 6, "0", STR_PAD_LEFT); 
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

    public function editar(Request $request){
        $this->repo = DocumentoRepository::GetInstance();
        $documento = $this->repo->find($request->id);
        $this->repo =  null;

        $this->repo = TipoDocumentoRepository::GetInstance();
        $tipos_documento = $this->repo->getAll();
        $tipoDoc = $this->repo->find($documento->tipo_documento);
        $this->repo =  null;

        $documento->numero = $tipoDoc->indicativo . '' . str_pad($documento->numero,6,"0",STR_PAD_LEFT); 
        $allData = [
            'tipos_documento' => $tipos_documento,
            'documento' => $documento
        ];
        return view('DocumentosPrincipales.editar',  $allData);
    }

    public function details(Request $request){
        $this->repo = DocumentoRepository::GetInstance();
        $objeto = $this->repo->find($request->id);
        $this->repo = null;
        $this->repo = TipoDocumentoRepository::GetInstance();
        $tipoDoc = $this->repo->find($objeto->tipo_documento);
        $this->repo = null;
        $objeto->numero = $tipoDoc->indicativo . '' . str_pad($objeto->numero,6,"0",STR_PAD_LEFT); 
        $objeto->tipo_documento = $tipoDoc->nombre;
        return json_encode($objeto);
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

    public function editarDocumento(Request $request){
        $validated = $request->validate($this->validationRulesEdit);
        //Primero obtendrá el documento guardado en la ruta temporal y si existe, entonces cargó el doc.
        //Sino existe, entonces no subió un documento
        $data = $request->all();

        if($data['recurrente_constante'] == 'constante'){
            $data['recurrente'] = false;
            $data['constante'] = true;
            $data['fecha_vencimiento'] = null;
            unset($data['fecha_vencimiento']);
        }else{
            $data['recurrente'] = true;
            $data['constante'] = false;
        }

        $this->repo = DocumentoRepository::GetInstance();
        //Este es el viejo documento
        $documento = $this->repo->find($data['id']);
        //si tiene el atributo data_file, entonces va actualizar
        if(isset($data['data_file'])){
            $newPathFile = "documentos_principales/".now()->timestamp."".$request->cargo_archivo;
            Storage::disk('local')->move($data['data_file'], $newPathFile);
            $data['path_file'] = $newPathFile;
            unset($data['recurrente_constante']);
            if(isset($data['data_file'])){
                unset($data['data_file']);
            }            
            $data['nombre_archivo'] = $request->cargo_archivo;
            $dataToSave = [
                'numero' => $documento['numero'],
                'nombre' => $data['nombre'],
                'nombre_archivo' => $data['nombre_archivo'],
                'descripcion' => isset($data['descripcion']) ? $data['descripcion'] : "N/A",
                'recurrente' => $data['recurrente'],
                'constante' => $data['constante'],
                'fecha_vencimiento' => isset($data['fecha_vencimiento']) ? Carbon::parse($data['fecha_vencimiento']) : null ,
                'path_file' => $data['path_file'],
                'estado' => 1,
                'tipo_documento' => $data['tipo_documento'],
                'created_at' => now(),
                'updated_at' => now()
            ];

            //Crea una nueva instancia de documento, la deja como padre y actualiza los demás registros
            $nuevoDocumento = $this->repo->create($dataToSave);
            $documento->padre = $nuevoDocumento->id;
            $documentosHijos = $this->repo->listarDocumentosHijos($documento->id);
            foreach($documentosHijos as $dh){
                //actualiza los demás docs con el nuevo padre
                $dh->padre = $nuevoDocumento->id;
                $dh->save();
            }
            $documento->save();
            $this->repo = null;
            return redirect(route('documento_principal.index'));
        }else{
            //Va a editar toda la data, menos el archivo
            $dataToSave = [
                'numero' => $documento['numero'],
                'nombre' => $data['nombre'],
                'nombre_archivo' => $documento['nombre_archivo'],
                'descripcion' => isset($data['descripcion']) ? $data['descripcion'] : "N/A",
                'recurrente' => $data['recurrente'],
                'constante' => $data['constante'],
                'fecha_vencimiento' => isset($data['fecha_vencimiento']) ? Carbon::parse($data['fecha_vencimiento']) : null ,
                'path_file' => $documento['path_file'],
                'estado' => 1,
                'tipo_documento' => $data['tipo_documento'],
                'created_at' => now(),
                'updated_at' => now()
            ];

            $data = $this->repo->update($documento, $dataToSave);
            $this->repo = null;
            return redirect(route('documento_principal.index'));
        }
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

            if($data['recurrente_constante'] == 'constante'){
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
                'fecha_vencimiento' => isset($data['fecha_vencimiento']) ? Carbon::parse($data['fecha_vencimiento']) : null ,
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

    public function destroy(Request $request, Document $documento)
    {
        $this->repo = DocumentoRepository::GetInstance();
        $data = $request->all();
        $data["estado"] = '3';
        $documento = $this->repo->find($data["id"]);
        $this->repo->update($documento, $data);
        $this->repo = null;
        return json_encode($documento);
    }

    public function obtenerDocumentosAnterioresVersiones(Request $request){
        $this->repo = DocumentoRepository::GetInstance();
        $documento = $this->repo->find($request->IdDocumento);
        $documentos = $this->repo->listarDocumentosHijos($documento->id);
        $this->repo = null;
        return json_encode([
            'status' => "success",
            "data" => [
                'padre' => $documento,
                'hijos' => $documentos
            ]
        ]);
    }

    //el IdDocumento que recibe es el que quiere restaurar
    public function reestablecerAnteriorVersionDocumento(Request $request){
        $this->repo = DocumentoRepository::GetInstance();
        $nuevoDocumentoPadre = $this->repo->find($request->IdDocumento);
        //Busca el que está actualmente
        $actualDocumentoPadre = $this->repo->find($nuevoDocumentoPadre->padre);

        //Busca las anteriores versiones del documento para actualizarles el padre
        $docsAnterioresVersiones = $this->repo->listarDocumentosHijos($actualDocumentoPadre->id);

        //Cambia el parentesco y lo guarda en la bd
        $actualDocumentoPadre->padre = $nuevoDocumentoPadre->id;
        $actualDocumentoPadre->save();

        foreach($docsAnterioresVersiones as $dav){
            $dav->padre = $nuevoDocumentoPadre->id;
            $dav->save();
        }

        $nuevoDocumentoPadre->padre = null;
        $nuevoDocumentoPadre->save();

        return json_encode([
            'status' => "success"
        ]);
    }

    public function eliminarDocumentoViejaVersion(Request $request){
        $this->repo = DocumentoRepository::GetInstance();
        $this->repo->eliminarDocumentoVersion($request->id);
        return back();
    }
}
