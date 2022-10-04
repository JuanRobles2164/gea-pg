<?php

namespace App\Repositories\FaseTipoDocumento;

use App\Models\FaseTipoDocumento;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FaseTipoDocumentoRepository extends BaseRepository{
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
        return new FaseTipoDocumento;
    }
    public function findByParams($params){
        
    }
}