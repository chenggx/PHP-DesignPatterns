<?php

namespace Decorator;

class AuthenticatedRequest extends HttpRequestDecorator
{
    private $apiKey;

    public function __construct(HttpRequest $httpRequest, $apiKey) {
        parent::__construct($httpRequest);
        $this->apiKey = $apiKey;
    }

    public function send($url, $data) {
        $data['api_key'] = $this->apiKey; // 添加身份验证
        parent::send($url, $data);
    }
}