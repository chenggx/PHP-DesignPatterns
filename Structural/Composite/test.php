<?php

require '../../vendor/autoload.php';

$file1 = new \Composite\ImageFile("图片1.png");
$file2 = new \Composite\ImageFile("图片2.jpg");
$file3 = new \Composite\TextFile("文件1.txt");

$folder1 = new \Composite\Directory("folder1");
$folder2 = new \Composite\Directory("folder2");

$folder1->add($file1);      // folder1 包含 file1
$folder1->add($file2);      // folder1 包含 file2
$folder2->add($file3);      // folder2 包含 file3

$rootDirectory = new \Composite\Directory("root");
$rootDirectory->add($folder1);  // root 目录包含 folder1
$rootDirectory->add($folder2);  // root 目录包含 folder2

$rootDirectory->display();      // 输出整个文件系统结构