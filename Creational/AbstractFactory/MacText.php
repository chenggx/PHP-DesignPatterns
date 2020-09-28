<?php


namespace Creational\AbstractFactory;


class MacText implements TextInterface
{
    public function display()
    {
        echo 'mac 风格文本框'.PHP_EOL;
    }
}
