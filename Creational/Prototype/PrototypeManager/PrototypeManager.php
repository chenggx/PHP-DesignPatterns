<?php


namespace Creational\Prototype\PrototypeManager;


class PrototypeManager
{
    public static $document = [];

    public static function addPrototype($name, OfficialDocument $value)
    {
        self::$document[$name] = $value;
    }

    public static function getPrototype($name)
    {
        return self::$document[$name]->copy();
    }

}
