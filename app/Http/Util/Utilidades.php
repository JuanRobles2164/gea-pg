<?php
namespace App\Http\Util;
class Utilidades{
    public static function obtenerInicial($nombre){
        $iniciales = '';
        $explode = explode(' ',$nombre);
        foreach($explode as $x){
            $iniciales .=  $x[0];
        }
        return $iniciales;
    }

}