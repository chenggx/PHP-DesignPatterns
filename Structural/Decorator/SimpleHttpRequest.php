<?php

namespace Decorator;

class SimpleHttpRequest implements HttpRequest
{
    public function send($url, $data)
    {
        echo "Sending request to $url with data: " . json_encode($data) . PHP_EOL;
    }
}