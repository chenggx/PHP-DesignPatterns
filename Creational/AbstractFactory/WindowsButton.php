<?php


namespace Creational\AbstractFactory;


class WindowsButton implements ButtonInterface
{
    public function display()
    {
        echo 'windows 风格按钮'.PHP_EOL;
    }
}
