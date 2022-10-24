<?php

namespace App\Repositories\Documento;

use App\Models\Documento;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DocumentoRepository extends BaseRepository{
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
        return new Documento;
    }
    public function findByParams($params){
        $paginado = 15;
        $acumulado = Documento::where('nombre', '=', $params["nombre"]);
        if(!empty($params["created_at"])){            
            $acumulado->where("created_at", "<=", Carbon::parse($params["created_at"]));
        }
        if(!empty($params["nombre"])){
            $acumulado->where("nombre", 'LIKE', "%".$params["nombre"]."%");
        }
        $acumulado->paginate($paginado);
        return $acumulado;
    }
    public function getAllPrincipales($paginate = 15, $estado = 3){
        return $this->getModel()->where("estado", "!=", $estado)->where("constante", true)->orWhere("recurrente", true)->paginate($paginate);
    }
}