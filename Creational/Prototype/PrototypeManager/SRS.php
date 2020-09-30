<?php


namespace Creational\Prototype\PrototypeManager;


class SRS implements OfficialDocument
{
    public function copy()
    {
        return clone $this;
    }

    public function display()
    {
        echo '《软件需求规格说明书》'.PHP_EOL;
    }
}
