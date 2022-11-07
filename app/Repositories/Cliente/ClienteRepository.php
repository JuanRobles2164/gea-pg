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

    public function getAllPersonalizado($criterio, $paginate = 10, $estado = 3){
        $response = $this->getModel()->where("estado", "!=", $estado);
        if($criterio != null && $criterio != ''){
            $response->where(function($query) use ($criterio){
                $query->razon($criterio)
                ->email($criterio)
                ->identificacion($criterio);
            });
        }
        return $response->paginate($paginate);
    }

    public function toggleState($clienteId){
        $cliente = $this->find($clienteId);
        $cliente->estado = ($cliente->estado - 3)*(-1);
        $cliente->save();
        return $cliente;
    }
}