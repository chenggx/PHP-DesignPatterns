<?php


namespace Creational\AbstractFactory;


class MacFactory implements AbstractFactory
{
    public function createButton()
    {
        return new MacButton();
    }

    public function createText()
    {
        return new MacText();
    }
}
