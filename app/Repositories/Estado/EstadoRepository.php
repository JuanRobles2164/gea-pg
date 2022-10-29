<?php

namespace App\Repositories\Estado;

use App\Models\Estado;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class EstadoRepository extends BaseRepository{
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
        return new Estado;
    }
    public function getAll($paginate = 15){
        return $this->getModel()->paginate($paginate);
    }
    public function findByParams($params){
        
    }
}