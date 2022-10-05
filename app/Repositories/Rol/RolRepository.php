<?php

namespace App\Repositories\Rol;

use App\Models\Rol;
use App\Repositories\BaseRepository;

class RolRepository extends BaseRepository{
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
        return new Rol;
    }
    public function findByParams($params){
        
    }
}