<?php

namespace App\Repositories\LicitacionFase;

use App\Models\LicitacionFase;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LicitacionFaseRepository extends BaseRepository{
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
        return new LicitacionFase;
    }
    public function findByParams($params){
        
    }
}