<?php


namespace Creational\AbstractFactory;


class MacText implements Text
{
    public function render()
    {
        echo 'mac Text'.PHP_EOL;
    }
}
