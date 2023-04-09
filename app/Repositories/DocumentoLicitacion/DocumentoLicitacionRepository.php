<?php

namespace App\Repositories\DocumentoLicitacion;

use App\Models\DocumentoLicitacion;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DocumentoLicitacionRepository extends BaseRepository{
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
        return new DocumentoLicitacion;
    }
    public function findByParams($params){
        $listado = $this->getModel()->where('estado', '!=', 3);
        if(isset($params['licitacion_fase'])){
            $listado = $listado->where('licitacion_fase', $params['licitacion_fase']);
        }
        if(isset($params['documento'])){
            $listado = $listado->where('documento', $params['documento']);
        }
        if(isset($params['registro_unico'])){
            return $listado->first();
        }
        return $listado->get();
    }
    public function findByParamsWithOutState($params){
        $listado = $this->getModel();
        if(isset($params['licitacion_fase'])){
            $listado = $listado->where('licitacion_fase', $params['licitacion_fase']);
        }
        if(isset($params['documento'])){
            $listado = $listado->where('documento', $params['documento']);
        }
        if(isset($params['registro_unico'])){
            return $listado->first();
        }
        return $listado->get();
    }

    public function createOrUpdate($params){
        $this->getModel()->updateOrInsert(
            [   'documento' => $params['documento_id'],
                'licitacion_fase' => $params['licitacion_fase_id']
            ], 
            [
                'estado' => 1,
                'revisado' => true,
                'updated_at' => now()
            ]);
            return true;
    }

    public function getDocumentosAsociadosFasesPorLicitacionFase($idLicitacionFase){
        $results = DB::table('documento_licitacion')
                        ->join('documento', 'documento_licitacion.documento', 'documento.id')
                        ->whereNotNull('documento.recurrente')
                        ->where('documento_licitacion.licitacion_fase', $idLicitacionFase)
                        ->select('documento_licitacion.*')
                        ->get();
        return $results;
    }
}