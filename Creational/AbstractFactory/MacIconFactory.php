<?php


namespace Creational\AbstractFactory;


class MacIconFactory implements IconFactory
{
    public function createIcon()
    {
        return new MacIcon();
    }
}
