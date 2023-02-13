<?php

use Structural\Adapter\NotificationInterface\EmailNotification;

require '../../vendor/autoload.php';

$notification = new EmailNotification("developers@example.com");
$notification->send('发生错误', '测试内容');


$wechatApi = new \Structural\Adapter\NotificationInterface\WeChatApi("aaaaaaakkkkkk", "sssssskkkkkk");
$notification = new \Structural\Adapter\NotificationInterface\WeChatNotification($wechatApi);
$notification->send('发生错误', '测试内容');