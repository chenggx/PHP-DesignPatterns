<?php

namespace Structural\Adapter\NotificationInterface;

class WeChatApi
{
    private $ak;
    private $sk;

    public function __construct($ak, $sk)
    {
        $this->ak = $ak;
        $this->sk = $sk;
    }

    public function getToken()
    {
        // 通过ak和sk 进行验证，获取token
        echo "登录成功 \n";
    }

    public function sendMessage($message)
    {
        echo "调用微信的发消息接口，消息为: '$message'.\n";
    }
}