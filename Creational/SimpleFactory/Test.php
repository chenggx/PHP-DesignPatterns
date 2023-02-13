<?php

use Creational\SimpleFactory\ChartFactory;

require '../../vendor/autoload.php';

$chart = ChartFactory::getChart('line');
$chart->display();

