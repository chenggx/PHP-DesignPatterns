<?php

namespace Creational\FactoryMethod;

class DatabaseLoggerFactory implements LoggerFactory
{
    public function createLogger()
    {
        // 模拟初始化数据库链接
        echo '初始化数据库链接' . PHP_EOL;

        return new DatabaseLogger();
    }
}
