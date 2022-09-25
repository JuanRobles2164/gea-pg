<?php

namespace App\Repositories\RolUsuario;

use App\Models\RolUsuario;
use App\Repositories\BaseRepository;

class RolUsuarioRepository extends BaseRepository{
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
        return new RolUsuario;
    }
    public function findByParams($params){
        
    }
}