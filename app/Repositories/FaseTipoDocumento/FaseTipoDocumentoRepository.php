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

    public function findByFaseId($idFase){
        $response = $this->getModel()->where('fase', $idFase)->get();
        return $response;
    }
    public function findByParams($params){
        
    }

    public function obtenerTiposDocsByFase($idFase, $estado = 3){
        $fasestd = DB::table('fase_tipo_documento')
        ->where('fase_tipo_documento.fase', '=', $idFase)
        ->where('fase_tipo_documento.estado','<>', $estado)
        ->select('fase_tipo_documento.*')
        ->get();
        return $fasestd;
    }
    public function updateftd($data){
        $update = FaseTipoDocumento::updateOrCreate(
            ['tipo_documento' => $data['tipo_documento'], 'fase' => $data['fase']],
            ['estado' => $data['estado']]
        );
        return $update;
    }
}