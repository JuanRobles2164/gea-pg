<?php

namespace App\Repositories\Categoria;

use App\Models\Categoria;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoriaRepository extends BaseRepository{
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
        return new Categoria;
    }
    public function findByParams($params){
        $paginado = 10;
        $consulta = Categoria::where('nombre', '=', $params["nombre"]);
        if(!empty($params["created_at"])){            
            $consulta->where("created_at", "<=", Carbon::parse($params["created_at"]));
        }
        if(!empty($params["nombre"])){
            $consulta->where("nombre", 'LIKE', "%".$params["nombre"]."%");
        }
        if(!empty($params['unico_registro'])){
            $consulta->first();
            return $consulta->get();
        }
        return $consulta;
    }
}