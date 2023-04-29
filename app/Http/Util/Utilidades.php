<?php
namespace App\Http\Util;

use Exception;

class Utilidades{
    public static function obtenerInicial($nombre){
        $iniciales = '';
        $explode = explode(' ',$nombre);
        foreach($explode as $x){
            $iniciales .=  $x[0];
        }
        return $iniciales;
    }

    public static function verificarPermisos($roles_usuario, $roles_permisos_requeridos){
        $permiso = false;
        if(gettype($roles_usuario) != "array"){
            return $permiso;
        }
        try{
            //Intenta autorizarse, sino se puede, entonces no tiene permisos
            foreach($roles_usuario as $ru){
                if(in_array($ru, $roles_permisos_requeridos)){
                    $permiso = true;
                    break;
                }
            }
            return $permiso;
        }catch(Exception $e){
            return false;
        }
    }
    public static function obtenerIndicativo($nombre){
        $iniciales = '';
        $explode = explode(" ", $nombre);
        foreach($explode as $x){
            $iniciales .=  $x[0];
            //$iniciales .=  $x[1];
        }
        return $iniciales;
    }

}