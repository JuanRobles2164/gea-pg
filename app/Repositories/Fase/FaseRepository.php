<?php

namespace App\Repositories\Fase;

use App\Models\Fase;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FaseRepository extends BaseRepository{
    private static $instance;
    private function __construct(){

    }
    public static function GetInstance() {
        if(!self::$instance instanceof self){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getModel() {
        return new Fase;
    }

    public function findByParams($idTipoLicitacion, $estado = 3) {
       $fases = DB::table('fase')
       ->join('fase_tipo_documento', 'fase.id','=','fase_tipo_documento.fase')
       ->where('fase.estado','<>',$estado)
       ->select('fase.*')
       ->get();
       return $fases;
    }

    public function obtenerFasesDocumentosByTipoLicitacion($idTipoLicitacion, $estado = 3){
        $fases = DB::table('fase_tipo_licitacion')
        ->join('fase', 'fase.id', '=', 'fase_tipo_licitacion.fase')
        ->where('fase_tipo_licitacion.tipo_licitacion', '=', $idTipoLicitacion)
        ->where('fase.estado','<>',$estado)
        ->where('fase_tipo_licitacion.estado','<>',$estado)
        ->select('fase.*')
        ->get();
        return $fases;
    }

    public function obtenerDocumentosByFaseId($idFase) {
        $documentos = DB::table('documento')
        ->join('tipo_documento', 'documento.tipo_documento', '=', 'tipo_documento.id')
        ->join('fase_tipo_documento', 'tipo_documento.id', '=', 'fase_tipo_documento.tipo_documento')
        ->where('fase_tipo_documento.fase', $idFase)
        ->select('documento.*', 'tipo_documento.*')
        ->get();
        
        return $documentos;
    }
}