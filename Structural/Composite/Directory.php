<?php

namespace Composite;

class Directory implements FileSystemComponent
{
    private $name;
    private $children = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    // 添加文件或文件夹
    public function add(FileSystemComponent $component)
    {
        $this->children[] = $component;
    }

    // 移除文件或文件夹
    public function remove(FileSystemComponent $component)
    {
        $key = array_search($component, $this->children, true);
        if ($key !== false) {
            unset($this->children[$key]);
        }
    }

    // 显示文件夹结构
    public function display()
    {
        echo "Directory: " . $this->name . PHP_EOL;
        foreach ($this->children as $child) {
            $child->display();
        }
    }
}