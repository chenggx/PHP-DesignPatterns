<?php

namespace Creational\FactoryMethod;

class FileLogger implements Logger
{
    public function writeLog()
    {
        echo '文件记录日志' . PHP_EOL;
    }
}