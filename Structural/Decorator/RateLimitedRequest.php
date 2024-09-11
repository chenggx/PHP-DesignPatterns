<?php

namespace Decorator;

class RateLimitedRequest extends HttpRequestDecorator
{
    private static $lastRequestTime = null;
    private $interval; // 请求间隔时间，单位为秒

    public function __construct(HttpRequest $httpRequest, $interval)
    {
        parent::__construct($httpRequest);
        $this->interval = $interval;
    }

    public function send($url, $data)
    {
        $now = time();
        if (self::$lastRequestTime && ($now - self::$lastRequestTime) < $this->interval) {
            echo "Request to $url blocked due to rate limiting.\n";
        } else {
            self::$lastRequestTime = $now;
            parent::send($url, $data);
        }
    }
}