<?php

namespace App\Repositories\Licitacion;

use App\Models\Licitacion;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LicitacionRepository extends BaseRepository{
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
        return new Licitacion;
    }
    public function findByParams($params){
        
    }
    public function getAllEstadosCategoria($idCategoria, $criterio, $estado = 3, $paginate = 10){
        return $this->getModel()->where("estado", "!=", $estado)
            ->where("categoria", $idCategoria)
            ->paginate($paginate);
    }

    public function getAllPersonalizado($criterio, $paginate = 10, $estado = 3){
        return $this->getModel()
        ->nombre($criterio)
        ->numero($criterio)
        ->where("estado", "!=", $estado)
        ->paginate($paginate);
    }

    public function getLicitacionesPorVencer($estado = 3, $paginate = 10){
        return $this->getModel()->where("estado", "!=", $estado)
            ->where("estado","<>","3")
            ->where('fecha_fin', '>=', now()->subDays(10))
            ->paginate($paginate);
    }
    public function getLicitacionesCreadasMes($estado = 3, $paginate = 10){
        return $this->getModel()->where("estado", "!=", $estado)
            ->where("estado","<>","3")
            ->where('created_at', '>=', now()->subDays(30))
            ->paginate($paginate);
    }
}