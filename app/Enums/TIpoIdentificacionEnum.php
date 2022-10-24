<?php
namespace App\Enums;

use App\Enums\BaseEnum;

class TipoIdentificacionEnum extends BaseEnum{

    private $CC = 1;
    private $NIT = 2;
    private $TI = 3;
    private $CE = 4;

    public static function getEnum(){
        self::fillEnumStatically();
        return self::$content;
    }

    public static function fillEnumStatically(){
        self::$content = [];
        array_push(self::$content, "Seleccione un tipo de identificacion...");
        array_push(self::$content, "CC");
        array_push(self::$content, "NIT");
        array_push(self::$content, "TI");
        array_push(self::$content, "CE");
    }

    function __construct()
    {
        $this->fillEnum();
    }

    public function fillEnum()
    {
        self::$content = [];
        array_push(self::$content, "Seleccione un tipo de identificacion...");
        array_push(self::$content, "CC");
        array_push(self::$content, "NIT");
        array_push(self::$content, "TI");
        array_push(self::$content, "CE");
    }

    public static function retornarTexto($id){
        self::fillEnum();
        return self::$content[$id];
    }

}