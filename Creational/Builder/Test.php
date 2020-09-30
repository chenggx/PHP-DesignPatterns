<?php

require 'vendor/autoload.php';

$controller = new \Creational\Builder\ActorController();

$actor = $controller->build(new \Creational\Builder\AngelBuilder());

echo $actor->getSex().PHP_EOL;
echo $actor->getType().PHP_EOL;
echo $actor->getHairstyle().PHP_EOL;
echo $actor->getFace().PHP_EOL;
echo $actor->getCostume().PHP_EOL;
