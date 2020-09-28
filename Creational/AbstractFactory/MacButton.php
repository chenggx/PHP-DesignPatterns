<?php


namespace Creational\AbstractFactory;


class MacButton implements ButtonInterface
{
    public function display()
    {
        echo 'mac 风格按钮'.PHP_EOL;
    }
}
