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
    public function getAllEstadosCategoria($idCategoria, $estado = 3, $paginate = 15){
        return $this->getModel()->where("estado", "!=", $estado)
            ->where("categoria", $idCategoria)
            ->paginate($paginate);
    }
}