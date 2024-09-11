<?php

namespace Decorator;

class LoggingRequest extends HttpRequestDecorator
{
    public function send($url, $data)
    {
        echo "Logging request to $url with data: " . json_encode($data) . PHP_EOL;
        parent::send($url, $data);
    }
}