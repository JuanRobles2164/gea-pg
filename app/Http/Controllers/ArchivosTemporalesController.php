<?php

namespace App\Http\Controllers;

use App\Repositories\Documento\DocumentoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ArchivosTemporalesController extends Controller
{
    private $repo;
    public function subirMultiplesArchivosTemporalesSimultaneo(Request $request){
        if($request->hasFile('data_file')){
            $archivos = $request->data_file;
            $file_paths = [];
            $file_names = [];
            foreach($archivos as $a){
                $file = $request->file('data_file');
                $filename = $file->getClientOriginalName();
                $folder = uniqid() . '-' . now()->timestamp;
                $file_path = Storage::disk('local')->put('documentos_temporales/', $file);
                array_push($file_paths, $file_path);
                array_push($file_names, $filename);
            }
            $request->session()->put('file_path', $file_path);
            $request->session()->put('file_name', $filename);
            return $file_path;
        }
        return [""];
    }

    public function subirUnicoArchivoGuardarEnMultiplesTemporales(Request $request){
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

    public function subirArchivoTemporal(Request $request){
        if($request->hasFile('data_file')){
            $file = $request->file('data_file');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file_path = Storage::disk('local')->put('documentos_temporales/', $file);
            return $file_path;
        }
        return "";
    }

    public function descargarArchivos(Request $request){
        $request->validate([
            'id' => ['required', 'exists:documento']
        ]);
        $this->repo = DocumentoRepository::GetInstance();
        $documentoInstance = $this->repo->find($request->id);
        return Storage::download($documentoInstance->path_file);
    }

    public function descargarArchivosConNombreTipoDocumento(Request $request){
        $request->validate([
            'id' => ['required', 'exists:documento']
        ]);
        $this->repo = DocumentoRepository::GetInstance();
        $documentoInstance = $this->repo->find($request->id);
        $documentoTipo = $documentoInstance->tipoDocumento()->nombre;
        $filePath = storage_path("app/".$documentoInstance->path_file);
        // Nombre personalizado para el archivo descargado
        $newFileName = $documentoTipo.'.'.pathinfo($filePath)['extension'];
        return Response::download($filePath, $newFileName);
    }

    public function verArchivoTemporal(Request $request){
        $path_file = $request->path_file;
        return Storage::response($path_file);
    }

    public function verArchivoNavegador(Request $request){
        $request->validate([
            'id' => ['required', 'exists:documento']
        ]);
        $this->repo = DocumentoRepository::GetInstance();
        $documentoInstance = $this->repo->find($request->id);
        return Storage::response($documentoInstance->path_file);
    }
}
