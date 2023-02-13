<?php

require '../../vendor/autoload.php';

$instance_1 = \Creational\Singleton\Singleton::getInstance();
$instance_2 = \Creational\Singleton\Singleton::getInstance();

var_dump($instance_1,$instance_2);
