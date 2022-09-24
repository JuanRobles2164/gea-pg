<?php

namespace App\Repositories\DocumentoLicitacion;

use App\Models\DocumentoLicitacion;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DocumentoLicitacionRepository extends BaseRepository{
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
        return new DocumentoLicitacion;
    }
    public function findByParams($params){
        
    }
    
}