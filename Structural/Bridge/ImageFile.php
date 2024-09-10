<?php

namespace Bridge;

// 扩展抽象类：图片文件
class ImageFile extends File {
    public function save() {
        $this->storage->store('ImageFile');
    }
}