<?php
namespace App\Http\Util;

use App\Repositories\Documento\DocumentoRepository;
use App\Repositories\TipoDocumento\TipoDocumentoRepository;

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
        foreach($roles_usuario as $ru){
            if(in_array($ru, $roles_permisos_requeridos)){
                $permiso = true;
                break;
            }
        }
        return $permiso;
    }
    public static function obtenerIndicativo($nombre){
        $iniciales = '';
        $explode = explode(' ',$nombre);
        foreach($explode as $x){
            $iniciales .=  $x[0];
            $iniciales .=  $x[1];
        }
        return $iniciales;
    }

    public static function completarNumeracionDocumento($idTipoDocumento, $objeto){
        $repo = null;
        $repo = TipoDocumentoRepository::GetInstance();
        $tipoDoc = $repo->find($idTipoDocumento);
        $repo = null;
        $objeto->numero = $tipoDoc->indicativo . '' . str_pad($objeto->numero, 6, "0", STR_PAD_LEFT);
        $objeto->tipo_documento = $tipoDoc->nombre;
        return $objeto;
    }

}