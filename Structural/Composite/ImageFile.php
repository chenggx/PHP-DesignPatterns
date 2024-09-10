<?php

namespace Composite;

class ImageFile implements FileSystemComponent
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function add(FileSystemComponent $component)
    {
        throw new \Exception('图片文件没有此方法');
    }

    public function remove(FileSystemComponent $component)
    {
        throw new \Exception('图片文件没有此方法');
    }

    public function display()
    {
        echo "Image File: " . $this->name . PHP_EOL;
    }
}