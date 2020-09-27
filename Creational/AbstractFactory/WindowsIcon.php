<?php


namespace Creational\AbstractFactory;


class WindowsIcon implements Icon
{
    public function render()
    {
        echo 'windows Icon'.PHP_EOL;
    }
}
