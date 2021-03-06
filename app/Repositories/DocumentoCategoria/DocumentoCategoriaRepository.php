<?php

namespace App\Repositories\DocumentoCategoria;

use App\Models\DocumentoCategoria;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DocumentoCategoriaRepository extends BaseRepository{
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
        return new DocumentoCategoria;
    }
    public function findByParams($params){
        
    }
}