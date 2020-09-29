<?php

require 'vendor/autoload.php';

$ob1 = new \Creational\Prototype\WeeklyLog();
$attachment = new \Creational\Prototype\Attachment();

$ob1->setAttachment($attachment);

$ob2 = unserialize($ob1->copy());

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
//$ob1->setName('小明');
//$ob1->setDate('第一周');
//$ob1->setContent('xxxxxx');
//
//
//echo '****周报****'.PHP_EOL;
//echo $ob1->getDate().PHP_EOL;
//echo $ob1->getName().PHP_EOL;
//echo $ob1->getContent().PHP_EOL;
//echo '--------------------------------'.PHP_EOL;
//
//
//$ob2 = $ob1->copy();
//$ob2->setDate('第二周');
//echo '****周报****'.PHP_EOL;
//echo $ob2->getDate().PHP_EOL;
//echo $ob2->getName().PHP_EOL;
//echo $ob2->getContent().PHP_EOL;
//echo '--------------------------------'.PHP_EOL;
