<?php

namespace App\Repositories\Documento;

use App\Models\Document;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DocumentoRepository extends BaseRepository{
    private static $instance;
    private function __construct(){

    }
    public static function GetInstance(){
        if(!self::$instance instanceof self){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getModel(){
        return new Document;
    }
    
    public function findByParams($params){
        $paginado = 10;
        $acumulado = Document::where('nombre', '=', $params["nombre"]);
        if(!empty($params["created_at"])){            
            $acumulado->where("created_at", "<=", Carbon::parse($params["created_at"]));
        }
        if(!empty($params["nombre"])){
            $acumulado->where("nombre", 'LIKE', "%".$params["nombre"]."%");
        }
        return $acumulado->get();
    }
    
    public function getAllPersonalizado($paginate = 10, $estado = 3){
        $response = $this->getModel()
        ->where("estado", "!=", $estado);
        return $response->where(function ($query) {
            $query->where("constante", true)
                  ->orWhere("recurrente", true);
        })->get();
    }

    public function obtenerDocumentosByFaseId($idFase) {
        $documentos = DB::table('fase_tipo_documento')
        ->join('tipo_documento', 'fase_tipo_documento.tipo_documento', '=', 'tipo_documento.id')
        ->join('documento', 'tipo_documento.id', '=', 'documento.tipo_documento')
        ->where('fase_tipo_documento.fase', $idFase)
        ->where(function($query){
            $query->where('documento.fecha_vencimiento', '>=', now())
                  ->orWhereNull('documento.fecha_vencimiento');
        })
        ->whereNull('padre')
        ->whereNotNull(['recurrente', 'constante'])
        ->where('documento.estado', 1)
        ->select('tipo_documento.*','documento.*')
        ->get();
        
        return $documentos;
    }

    public function listarDocumentosMaestros(){
        return $this->getModel()
                    ->whereNull('padre')
                    ->whereNotNull('recurrente')
                    ->whereNotNull('constante')
                    ->get();
    }

    //Listará solo los recurrentes, que son los que vencen
    public function listarDocumentosActivosVencidos(){
        return $this->getModel()
                ->where('estado', 1)
                ->whereNull('padre')
                ->where('recurrente', 1)
                ->whereNotNull('fecha_vencimiento')
                ->where('fecha_vencimiento', '<', Carbon::today())
                ->get();

    }

    public function listarDocumentosHijos($idPadre){
        return $this->getModel()
                    ->where('padre', $idPadre)
                    ->get();
    }

    public function toggleState($documentoId){
        $documento = $this->find($documentoId);
        $documento->estado = ($documento->estado - 3)*(-1);
        $documento->save();
        return $documento;
    }

    
}