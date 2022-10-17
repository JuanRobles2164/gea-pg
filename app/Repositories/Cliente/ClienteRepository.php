<?php

namespace App\Repositories\Cliente;

use App\Models\Cliente;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ClienteRepository extends BaseRepository{
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
        return new Cliente;
    }
    public function findByParams($params){
        
    }

    //Si es Activo (1), al restarle 3 quedará -2 (Inexistente)
    //Y al aplicar Valor absoluto, quedará 2 (Inactivo)
    //TREMENDO MINDFUCK HOLY SHIET :o
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