<?php

namespace Composite;

class TextFile implements FileSystemComponent
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function add(FileSystemComponent $component)
    {
        throw new \Exception('文本文件没有此方法');
    }

    public function remove(FileSystemComponent $component)
    {
        throw new \Exception('文本文件没有此方法');
    }

    public function display()
    {
        echo "Text File: " . $this->name . PHP_EOL;
    }
}