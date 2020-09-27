<?php


namespace Creational\AbstractFactory;


class WindowsButton implements Button
{
    public function render()
    {
        echo 'windows button'.PHP_EOL;
    }
}
