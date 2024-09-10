<?php

namespace Bridge;

class LocalStorage implements Storage {
    public function store($file) {
        echo "存储 $file 到本地".PHP_EOL;
    }
}