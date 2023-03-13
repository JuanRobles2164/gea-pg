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

    public function getAllPersonalizado($paginate = 10, $estado = 3){
        $response = $this->getModel()->where("estado", "!=", $estado)->get();
        return $response;
    }

    public function toggleState($clienteId){
        $cliente = $this->find($clienteId);
        $cliente->estado = ($cliente->estado - 3)*(-1);
        $cliente->save();
        return $cliente;
    }
}