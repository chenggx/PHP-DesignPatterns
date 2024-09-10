<?php

namespace Bridge;

// 抽象部分：文件类
abstract class File {
    protected $storage;

    public function __construct(Storage $storage) {
        $this->storage = $storage;
    }

    abstract public function save();
}