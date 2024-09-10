<?php

namespace Composite;

interface FileSystemComponent
{
    public function add(FileSystemComponent $component);

    public function remove(FileSystemComponent $component);

    public function display();
}