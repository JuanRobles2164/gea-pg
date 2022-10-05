<?php

namespace App\Repositories\Iteracion;

use App\Models\Iteracion;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IteracionRepository extends BaseRepository{
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
        return new Iteracion;
    }
    public function findByParams($params){
        
    }
}