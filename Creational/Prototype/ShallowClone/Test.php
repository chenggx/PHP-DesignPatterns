<?php
require 'vendor/autoload.php';

echo '******测试浅克隆************'.PHP_EOL;
$ob1 = new \Creational\Prototype\ShallowClone\WeeklyLog();
$attachment = new \Creational\Prototype\ShallowClone\Attachment();

$ob1->setAttachment($attachment);

$ob2 = $ob1->copy();

if ($ob1 === $ob2) {
    echo '周报是相同的'.PHP_EOL;
} else {
    echo '周报是不同的'.PHP_EOL;
}

if ($ob1->getAttachment() === $ob2->getAttachment()) {
    echo '附件是相同的'.PHP_EOL;
} else {
    echo '附件是不同的'.PHP_EOL;
}
