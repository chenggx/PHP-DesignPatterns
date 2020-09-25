<?php

use Creational\FactoryMethod\DatabaseLoggerFactory;

require 'vendor/autoload.php';

$factory = new DatabaseLoggerFactory();

$logger = $factory->createLogger();

$logger->writeLog();
