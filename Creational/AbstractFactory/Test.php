<?php

require '../../vendor/autoload.php';

$skin = new \Creational\AbstractFactory\WindowsFactory();

$button = $skin->createButton();
$text = $skin->createText();

$button->display();
$text->display();
