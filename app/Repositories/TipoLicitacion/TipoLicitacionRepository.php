<?php

namespace App\Repositories\TipoLicitacion;

use App\Models\TipoLicitacion;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TipoLicitacionRepository extends BaseRepository{
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
        return new TipoLicitacion;
    }
    public function findByParams($params){
        
    }
    public function toggleState($tipoLicId){
        $tipoLic = $this->find($tipoLicId);
        $tipoLic->estado = ($tipoLic->estado - 3)*(-1);
        $tipoLic->save();
        return $tipoLic;
    }
    public function getAllPersonalizado($paginate = 10, $estado = 3){
        $response = $this->getModel()->where("estado", "!=", $estado);
        return $response->get();
    }
    public function obtenerNumeracionActual($idTipoLic){
        $numeracion = DB::table('tipo_licitacion')
        ->where('tipo_licitacion.id',$idTipoLic)
        ->select('tipo_licitacion.valor_actual as valor')
        ->get();
        return $numeracion;
    }

    public function obtenerNumeracionActualYActualizar($idTipoLic){
        $tipoLic = $this->find($idTipoLic);
        $tipoLic->valor_actual = $tipoLic->valor_actual + 1;
        $tipoLic->updated_at = now();
        $tipoLic->save();
        return $tipoLic->valor_actual;
    }
}