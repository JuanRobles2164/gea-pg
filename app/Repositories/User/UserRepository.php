<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository{
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
        return new User;
    }
    public function findByParams($params){
        
    }
    public function resetPassword($userId){
        $usuario = DB::table('users')->find($userId);
        //return $usuario;
        $usuarioActualizar = DB::table('users')
        ->where('id', '=', $usuario->id)
        ->update(['password' => Hash::make($usuario->identificacion)]);
        return $usuarioActualizar;
    }

    //Si es Activo (1), al restarle 3 quedará -2 (Inexistente)
    //Y al aplicar Valor absoluto, quedará 2 (Inactivo)
    //TREMENDO MINDFUCK HOLY SHIET :o
    public function toggleState($userId){
        $usuario = $this->find($userId);
        $usuario->estado = ($usuario->estado - 3)*(-1);
        $usuario->save();
        return $usuario;
    }
}


