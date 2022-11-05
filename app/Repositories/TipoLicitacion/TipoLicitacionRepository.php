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
    public function getAllPersonalizado($criterio, $paginate = 10, $estado = 1){
        return $this->getModel()
        ->nombre($criterio)
        ->descripcion($criterio)
        ->indicativo($criterio)
        ->paginate($paginate)
        ->where("estado", "!=", $estado);
    }
    public function obtenerNumeracionActual($idTipoLic){
        $numeracion = DB::table('tipo_licitacion')
        ->where('tipo_licitacion.id',$idTipoLic)
        ->select('tipo_licitacion.valor_actual as valor')
        ->get();
        return $numeracion;
    }
}