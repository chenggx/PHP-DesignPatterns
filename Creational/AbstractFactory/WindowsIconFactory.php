<?php


namespace Creational\AbstractFactory;


class WindowsIconFactory implements IconFactory
{
    public function createIcon()
    {
        return new WindowsIcon();
    }
}
