<?php

use Creational\Prototype\PrototypeManager\FAR;
use Creational\Prototype\PrototypeManager\PrototypeManager;
use Creational\Prototype\PrototypeManager\SRS;

require 'vendor/autoload.php';

PrototypeManager::addPrototype('far', new FAR());
$doc1 = PrototypeManager::getPrototype('far');
$doc1->display();

$doc2 = PrototypeManager::getPrototype('far');
$doc2->display();

var_dump($doc1 === $doc2);


PrototypeManager::addPrototype('srs', new SRS());
$doc3 = PrototypeManager::getPrototype('srs');
$doc3->display();

$doc4 = PrototypeManager::getPrototype('srs');
$doc4->display();

var_dump($doc3 === $doc4);

