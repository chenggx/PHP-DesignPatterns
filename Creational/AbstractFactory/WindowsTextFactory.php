<?php


namespace Creational\AbstractFactory;


class WindowsTextFactory implements TextFactory
{
    public function createText()
    {
        return new WindowsText();
    }
}
