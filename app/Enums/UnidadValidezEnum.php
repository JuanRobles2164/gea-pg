<?php
use App\Enums\BaseEnum;
namespace App\Enums;

class UnidadValidezEnum extends BaseEnum{
    private $DIA = 1;
    private $SEMANA = 2;
    private $MES = 3;
    private $ANNO = 4;

    public static function getEnum(){
        return self::$content;
    }

    function __construct()
    {
        $this->fillEnum();
    }

    public function fillEnum()
    {
        self::$content = [];
        array_push(self::$content, "-1");
        array_push(self::$content, "DIAS");
        array_push(self::$content, "SEMANAS");
        array_push(self::$content, "MESES");
        array_push(self::$content, "AÑOS");
    }

    public static function retornarTexto($id){
        self::fillEnum();
        return self::$content[$id];
    }

}