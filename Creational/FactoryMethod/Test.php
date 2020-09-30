<?php

use Creational\FactoryMethod\DatabaseLoggerFactory;

require 'vendor/autoload.php';

// 通过反射

//配置文件可以放在单独的文件中
$config = [
    'LoggerFactory' => DatabaseLoggerFactory::class
];

$class = new ReflectionClass($config['LoggerFactory']);

$factory = $class->newInstance();

$logger = $factory->createLogger();

$logger->writeLog();

// 普通模式

// $factory = new Creational\FactoryMethod\DatabaseLoggerFactory();

// $logger = $factory->createLogger();

// $logger->writeLog();
