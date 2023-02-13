<?php

namespace Structural\Adapter\NotificationInterface;

class WeChatNotification implements NotificationInterface
{
    private $wechat;

    public function __construct(WeChatApi $wechat)
    {
        $this->wechat = $wechat;
    }

    public function send($title, $message)
    {
        $slackMessage = "#" . $title . "# " . strip_tags($message);
        $this->wechat->getToken();
        $this->wechat->sendMessage($slackMessage);
    }
}