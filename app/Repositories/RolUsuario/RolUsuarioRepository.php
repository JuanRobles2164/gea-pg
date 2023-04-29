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
        $idUsuario = $rolesUsuario[0]['usuario'];
        foreach($rolesUsuario as $ru){
            array_push($roles_ids, $ru['rol']);
        }
        $registros = [];
        $registros_nuevos = [];
        $roles_originales = DB::table('rol_usuario')->where('usuario', $idUsuario);
        if($roles_originales != null){
            foreach($roles_originales->cursor() as $elemento){
                //Si coincide con los elementos recibidos, deberá setearlo como activo y asignado
                if(in_array($elemento->rol, $roles_ids)){
                    array_push($registros, [
                        'id' => $elemento->id,
                        'rol' => $elemento->rol,
                        'usuario' => $elemento->usuario,
                        'estado' => 1
                    ]);
                    if (($key = array_search($elemento->rol, $roles_ids)) !== false) {
                        unset($roles_ids[$key]);
                    }
                }else{
                    //Si no coincide con los elementos recibidos, deberá setearlo como inactivo
                    array_push($registros, [
                        'id' => $elemento->id,
                        'rol' => $elemento->rol,
                        'usuario' => $idUsuario,
                        'estado' => 2
                    ]);
                }
            }
            //si no encontró estos roles, es porque falta asignarlos
            foreach($roles_ids as $rid){
                array_push($registros_nuevos, [
                    'rol' => $rid,
                    "usuario" => $idUsuario,
                    "estado" => 1
                ]);
            }
        }else{
            //Si no tiene roles asignados, deberá agregarlos
            foreach($roles_ids as $rol){
                array_push($registros_nuevos, [
                    'rol' => $rol,
                    'usuario' => $idUsuario,
                    'estado' => 1
                ]);
            }
        }

        $roles_usuario_actuales = $this->getModel()->upsert($registros, ['id', 'rol', 'usuario']);
        if(count($registros_nuevos) != 0){
            $this->getModel()->insert($registros_nuevos);
        }
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

    public function obtenerRolesPorUsuario($usuarioId){
        return DB::table('rol_usuario')
                ->where('estado', 1)
                ->where('usuario', '=', $usuarioId)
                ->get('rol');
    }
}