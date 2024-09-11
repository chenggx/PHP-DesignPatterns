<?php
require '../../vendor/autoload.php';

use Decorator\AuthenticatedRequest;
use Decorator\LoggingRequest;
use Decorator\RateLimitedRequest;
use Decorator\SimpleHttpRequest;



$httpRequest = new SimpleHttpRequest();

// 添加身份验证
$authenticatedRequest = new AuthenticatedRequest($httpRequest, 'my_api_key_123');

// 添加日志记录
$loggingRequest = new LoggingRequest($authenticatedRequest);

// 添加限流功能，限制每次请求间隔至少为 2 秒
$rateLimitedRequest = new RateLimitedRequest($loggingRequest, 2);

// 模拟发送请求
$rateLimitedRequest->send("https://api.example.com/data", ['param1' => 'value1']);

// 再次发送（限流阻止）
sleep(1); // 等待 1 秒
$rateLimitedRequest->send("https://api.example.com/data", ['param1' => 'value1']);

// 再次发送（限流通过）
sleep(2); // 等待 2 秒
$rateLimitedRequest->send("https://api.example.com/data", ['param1' => 'value1']);