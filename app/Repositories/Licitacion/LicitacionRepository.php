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
    public function getAllEstadosCategoria($idCategoria, $estado = 3, $paginate = 10){
        $response = $this->getModel()->where("estado", "!=", $estado)->where("categoria", $idCategoria);
        return $response->get();
    }

    //Estado = 4. En desarrollo
    public function getAllLicitacionesPorVencer($estado = 4){
        return $this->getModel()->where('estado', 4)->get();
    }

    public function getAllPersonalizado($paginate = 10, $estado = 3){
        $response = $this->getModel()->where("estado", "!=", $estado);
        return $response->get();
    }

    public function getLicitacionesPorVencer($estado = 3, $paginate = 10){
        return $this->getModel()->where("estado", "!=", $estado)
            ->where("estado","<>","3")
            ->where('fecha_fin', '>=', now()->subDays(10))->get();
    }
    public function getLicitacionesCreadasMes($estado = 3, $paginate = 10){
        return $this->getModel()->where("estado", "!=", $estado)
            ->where("estado","<>","3")
            ->where('created_at', '>=', now()->subDays(30))->get();
    }
}