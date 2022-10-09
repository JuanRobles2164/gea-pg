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

    public function updateRoles($rolesUsuario){
        $roles_ids = [];
        foreach($rolesUsuario as $ru){
            array_push($roles_ids, $ru['rol']);
        }
        $roles_usuario_actuales = DB::table('rol_usuario')->where('usuario', $rolesUsuario[0]['usuario'])
        ->where('rol', $roles_ids)
        ->update(['activo' => true]);

        DB::table('rol_usuario')->where('usuario', $rolesUsuario[0]['usuario'])
        ->whereNotIn('rol', $roles_ids)
        ->update(['activo' => false]);
        return $roles_usuario_actuales;
    }

    public function findByUser($userId){
        return RolUsuario::where('usuario', $userId)->get();
    }

    public function findByParams($params){
        return DB::table('rol_usuario')->where('usuario', $params['usuario'])->get();
    }

    /**
     * @param array $roles Arreglo de entidades de tipo RolUsuario con el id del usuario y el id del rol en sí
     */
    public function asignarRoles($roles){

    }

    /**
     * @param RolUsuario objeto de tipo Rol que contiene el id del rol asignado y el usuario
     */
    public function asignarRol($rol){
        $rol_usuario = null;
        $rol_usuario = RolUsuario::updateOrCreate([
            'usuario' => $rol['usuario'],
            'rol' => $rol['rol']
        ]);
        return $rol_usuario;
    }
}