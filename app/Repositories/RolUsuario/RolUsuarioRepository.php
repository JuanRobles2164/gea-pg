<?php

namespace App\Repositories\RolUsuario;

use App\Models\RolUsuario;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RolUsuarioRepository extends BaseRepository{
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
        return new RolUsuario;
    }
    public function findByParams($params){
        
    }

    /**
     * @param array $roles Arreglo de entidades de tipo RolUsuario con el id del usuario y el id del rol en sí
     */
    public function asignarRoles($roles){

    }

    /**
     * @param Rol objeto de tipo Rol que contiene el id del rol asignado y el usuario
     */
    public function asignarRol($rol){
        $roles_usuario = DB::table("rol_usuario")->where("usuario", "=", $rol->usuario);
        $encontrado = false;
        for($i = 0; $i < count($roles_usuario); $i++){
            if($rol->rol == $roles_usuario[$i]->rol){
                $encontrado = true;
            }
        }
        $rol_usuario = null;
        if($encontrado){
            $rol_usuario = RolUsuario::updateOrCreate([
                'usuario' => $rol->usuario,
                'rol' => $rol->rol
            ]);
        }
        return $rol_usuario;
    }
}