<?php


namespace Creational\AbstractFactory;


class MacTextFactory implements TextFactory
{
    public function createText()
    {
        return new MacText();
    }
}
