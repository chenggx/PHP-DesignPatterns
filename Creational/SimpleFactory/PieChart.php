<?php

namespace Creational\SimpleFactory;

class PieChart implements Chart
{
    public function __construct()
    {
        echo '初始化饼状图' . PHP_EOL;
    }

    public function display()
    {
        echo '显示化饼状图' . PHP_EOL;
    }
}
