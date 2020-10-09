<?php

namespace App\Enums;

use ReflectionClass;

class UserType
{
    const ADMIN     = 1;
    const TEACHER   = 2;
    const STUDENT   = 3;

    public static function getItems()
    {
        $class = new ReflectionClass(__CLASS__);
        return array_flip($class->getConstants());
    }

    public static function getItem($item)
    {
        $items = self::getItems();
        return (isset($items[$item])) ? $items[$item] : "Undefined";
    }
}