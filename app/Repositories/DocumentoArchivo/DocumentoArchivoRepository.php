<?php

namespace App\Repositories\DocumentoArchivo;

use App\Models\DocumentoArchivo;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DocumentoArchivoRepository extends BaseRepository{
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
        return new DocumentoArchivo;
    }
    public function findByParams($params){
        
    }
}