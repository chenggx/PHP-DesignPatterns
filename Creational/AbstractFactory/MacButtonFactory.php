<?php


namespace Creational\AbstractFactory;


class MacButtonFactory implements ButtonFactory
{
    public function createButton()
    {
        return new MacButton();
    }
}
