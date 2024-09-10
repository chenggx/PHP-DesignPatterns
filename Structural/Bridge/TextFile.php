<?php

namespace Bridge;

// 扩展抽象类：文本文件
class TextFile extends File {
    public function save() {
        $this->storage->store('TextFile');
    }
}