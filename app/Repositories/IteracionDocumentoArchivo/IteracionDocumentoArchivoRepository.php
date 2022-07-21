<?php

namespace App\Repositories\IteracionDocumentoArchivo;

use App\Models\IteracionDocumentoArchivo;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IteracionDocumentoArchivoRepository extends BaseRepository{
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
        return new IteracionDocumentoArchivo;
    }
}