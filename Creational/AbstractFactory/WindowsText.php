<?php


namespace Creational\AbstractFactory;


class WindowsText implements Text
{
    public function render()
    {
        echo 'windows Text'.PHP_EOL;
    }
}
