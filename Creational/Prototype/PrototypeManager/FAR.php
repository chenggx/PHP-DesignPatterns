<?php


namespace Creational\Prototype\PrototypeManager;


class FAR implements OfficialDocument
{
    public function copy()
    {
        return clone $this;
    }

    public function display()
    {
        echo '《可行性分析报告》'.PHP_EOL;
    }
}
