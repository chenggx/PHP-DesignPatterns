<?php

namespace Bridge;

// 具体实现类：云存储方式
class CloudStorage implements Storage {
    public function store($file) {
        echo "存储 $file 到云端".PHP_EOL;
    }
}