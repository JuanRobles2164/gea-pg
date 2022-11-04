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
    public function getModel()
    {
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
        $acumulado->paginate($paginado);
        return $acumulado;
    }
    public function getAllPrincipales($paginate = 10, $estado = 3){
        return $this->getModel()->where("estado", "!=", $estado)->where("constante", true)->orWhere("recurrente", true)->paginate($paginate);
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
        ->where('documento.estado', 1)
        ->select('tipo_documento.*','documento.*')
        ->get();
        
        return $documentos;
    }

    public function toggleState($documentoId){
        $documento = $this->find($documentoId);
        $documento->estado = ($documento->estado - 3)*(-1);
        $documento->save();
        return $documento;
    }

    
}