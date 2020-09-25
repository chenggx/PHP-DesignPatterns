<?php

namespace Creational\FactoryMethod;

class FileLoggerFactory implements LoggerFactory
{
    public function createLogger()
    {
        return new FileLogger();
    }
}
