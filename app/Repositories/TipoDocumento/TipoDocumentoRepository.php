<?php

namespace App\Repositories\TipoDocumento;

use App\Models\TipoDocumento;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TipoDocumentoRepository extends BaseRepository{
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
        return new TipoDocumento;
    }
    public function findByParams($params){
        
    }

    public function toggleState($tipoDocId){
        $tipoDoc = $this->find($tipoDocId);
        $tipoDoc->estado = ($tipoDoc->estado - 3)*(-1);
        $tipoDoc->save();
        return $tipoDoc;
    }

    public function obtenerTipoDocumentosByFase($idFase, $estado = 3){
        $tiposDoc = DB::table('fase_tipo_documento')
        ->join('tipo_documento', 'tipo_documento.id', '=', 'fase_tipo_documento.tipo_documento')
        ->where('fase_tipo_documento.fase', '=', $idFase)
        ->where('tipo_documento.estado','<>',$estado)
        ->where('fase_tipo_documento.estado','<>',$estado)
        ->select('tipo_documento.*')
        ->get();
        return $tiposDoc;
    }

    public function getAllPersonalizado($criterio, $paginate = 10, $estado = 3){
        return $this->getModel()
        ->nombre($criterio)
        ->descripcion($criterio)
        ->where("estado", "!=", $estado)
        ->paginate($paginate);
    }

    public function obtenerNumeracionActual($idTipoDoc){
        $numeracion = DB::table('tipo_documento')
        ->where('tipo_documento.id',$idTipoDoc)
        ->select('tipo_documento.valor_actual as valor')
        ->get();
        return $numeracion;
    }
}