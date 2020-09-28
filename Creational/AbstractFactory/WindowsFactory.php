<?php


namespace Creational\AbstractFactory;


class WindowsFactory implements AbstractFactory
{
    public function createButton()
    {
        return new WindowsButton();
    }

    public function createText()
    {
        return new WindowsText();
    }
}
