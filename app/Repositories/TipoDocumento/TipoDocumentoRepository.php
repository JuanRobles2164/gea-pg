<?php

namespace App\Repositories\TipoDocumento;

use App\Models\TipoDocumento;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TipoDocumentoRepository extends BaseRepository{
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
        return new TipoDocumento;
    }
    public function findByParams($params){
        
    }

    public function toggleState($clienteId){
        $cliente = $this->find($clienteId);
        if($cliente->estado == 1){
            $cliente->estado = 2;
        }else{
            $cliente->estado = 1;
        }
        
        $cliente->save();
        return $cliente;
    }
}