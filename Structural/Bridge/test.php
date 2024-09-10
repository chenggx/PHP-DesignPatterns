<?php

use Bridge\CloudStorage;
use Bridge\ImageFile;
use Bridge\LocalStorage;
use Bridge\TextFile;

require '../../vendor/autoload.php';

$textFileOnLocal = new TextFile(new LocalStorage());
$imageFileOnCloud = new ImageFile(new CloudStorage());

$textFileOnLocal->save();   // 输出: 存储 TextFile 到本地".
$imageFileOnCloud->save();  // 输出: 存储 ImageFile 到云端.