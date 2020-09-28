<?php


namespace Creational\AbstractFactory;


class WindowsText implements TextInterface
{
    public function display()
    {
        echo 'windows 风格文本框'.PHP_EOL;
    }
}
