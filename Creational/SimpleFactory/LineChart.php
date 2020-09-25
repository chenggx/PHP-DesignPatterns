<?php

namespace Creational\SimpleFactory;

class LineChart implements Chart
{
    public function __construct()
    {
        echo '初始化折线图' . PHP_EOL;
    }

    public function display()
    {
        echo '显示化折线图' . PHP_EOL;
    }
}
