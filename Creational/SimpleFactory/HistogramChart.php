<?php

namespace Creational\SimpleFactory;

class HistogramChart implements Chart
{
    public function __construct()
    {
        echo '初始化柱状图' . PHP_EOL;
    }

    public function display()
    {
        echo '显示化柱状图' . PHP_EOL;
    }
}
