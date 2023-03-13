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

    public function obtenerFasesByTipoLicitacion($idTipoLicitacion,  $estado = 3){
        $fases = DB::table('fase_tipo_licitacion')
        ->join('fase', 'fase.id', '=', 'fase_tipo_licitacion.fase')
        ->where('fase_tipo_licitacion.tipo_licitacion', '=', $idTipoLicitacion)
        ->where('fase.estado',1)
        ->where('fase_tipo_licitacion.estado','<>',$estado)
        ->select('fase.*')
        ->get();
        return $fases;
    }

    public function getAllPersonalizado($paginate = 10, $estado = 3){
        $response = $this->getModel()->where("estado", "!=", $estado)->get();
        return $response;
    }

    public function toggleState($faseId){
        $fase = $this->find($faseId);
        $fase->estado = ($fase->estado - 3)*(-1);
        $fase->save();
        return $fase;
    }
}