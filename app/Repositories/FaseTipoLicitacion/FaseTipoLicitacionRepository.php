<?php

namespace App\Repositories\FaseTipoLicitacion;

use App\Models\FaseTipoLicitacion;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FaseTipoLicitacionRepository extends BaseRepository{
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
        return new FaseTipoLicitacion;
    }
    public function findByParams($params){
        
    }
    
    public function obtenerFasesTLByTipoLicitacion($idTipoLicitacion, $estado = 3){
        $fasestl = DB::table('fase_tipo_licitacion')
        ->where('fase_tipo_licitacion.tipo_licitacion', '=', $idTipoLicitacion)
        ->where('fase_tipo_licitacion.estado','<>', $estado)
        ->select('fase_tipo_licitacion.*')
        ->get();
        return $fasestl;
    }
    public function updateftl($data){
        $parametros = null;
        if(array_key_exists('estado', $data)){
            $parametros = ['estado' => $data['estado']];
        }else{
            $parametros = ['orden' => $data['orden']];
        }
        $update = FaseTipoLicitacion::updateOrCreate(
            ['tipo_licitacion' => $data['tipo_licitacion'], 'fase' => $data['fase']],
            $parametros
        );
        return $update;
    }
}