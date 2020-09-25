<?php

namespace Creational\FactoryMethod;

class DatabaseLogger implements Logger
{
    public function writeLog()
    {
        echo '数据库记录日志' . PHP_EOL;
    }
}
