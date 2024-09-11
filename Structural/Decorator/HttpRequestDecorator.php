<?php

namespace Decorator;

abstract class HttpRequestDecorator implements HttpRequest
{
    protected $httpRequest;

    public function __construct(HttpRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    public function send($url, $data)
    {
        $this->httpRequest->send($url, $data);
    }
}