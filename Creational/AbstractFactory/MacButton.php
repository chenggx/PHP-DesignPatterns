<?php


namespace Creational\AbstractFactory;


class MacButton implements Button
{
    public function render()
    {
        echo 'mac button'.PHP_EOL;
    }
}
