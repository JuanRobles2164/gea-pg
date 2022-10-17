<?php

use App\Enums\BaseEnum;

class AdminEnum extends BaseEnum{

    public function __construct()
    {
        
    }
    public static function getEnum()
    {
        
    }

    public function fillEnum()
    {
        $ELEMENTO1 = ['id' => 1, 'nombre' => ''];
        array_push(self::$content, $ELEMENTO1);
    }
}