<?php

namespace App\Repositories\Licitacion;

use App\Models\Licitacion;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
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
        $response = $this->getModel()->where("estado", "!=", $estado)->where("categoria", $idCategoria);
        if($criterio != null && $criterio != ''){
            $response->where(function($query) use ($criterio){
                $query->nombre($criterio)
                ->numero($criterio);
            });
        }
        return $response->paginate($paginate);;
    }

    public function getAllPersonalizado($criterio, $paginate = 10, $estado = 3){
        $response = $this->getModel()->where("estado", "!=", $estado);
        if($criterio != null && $criterio != ''){
            $response->where(function($query) use ($criterio){
                $query->nombre($criterio)
                    ->numero($criterio);
            });
        }
        return $response->paginate($paginate);
    }

    public function getLicitacionesPorVencer($estado = 3, $paginate = 10){
        return $this->getModel()->where("estado", "!=", $estado)
            ->where("estado","<>","3")
            ->where('fecha_fin', '>=', Carbon::now()->timestamp)
            ->where("fecha_fin", '<=', Carbon::now()->addMonth(1))
            ->paginate($paginate);
    }
    public function getLicitacionesCreadasMes($estado = 3, $paginate = 10){
        return $this->getModel()->where("estado", "!=", $estado)
            ->where("estado","<>","3")
            ->where('created_at', '>=', now()->subDays(30))
            ->paginate($paginate);
    }
    public function getLicitacionesCreadasAnual($estado = 3, $paginate = 10){
        return $this->getModel()->where("estado", "!=", $estado)
            ->where("estado","<>","3")
            ->where('created_at', '>=', Carbon::today()->year()->timestamp)
            ->paginate($paginate);
    }
}