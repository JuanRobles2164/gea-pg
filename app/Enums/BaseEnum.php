<?php

namespace App\Enums;

abstract class BaseEnum{
    protected static $content = [];
    function __construct()
    {
        
    }
    public abstract static function getEnum();
    public abstract function fillEnum();
}