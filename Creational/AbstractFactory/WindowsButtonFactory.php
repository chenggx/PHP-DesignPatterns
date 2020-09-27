<?php


namespace Creational\AbstractFactory;


class WindowsButtonFactory implements ButtonFactory
{
    public function createButton()
    {
        return new WindowsButton();
    }
}
