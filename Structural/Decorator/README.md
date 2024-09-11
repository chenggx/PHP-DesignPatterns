**装饰模式（ Decorator Pattern）**
是一种结构型设计模式，在不改变对象本身的结构外，动态的给对象增加一些额外的职责，而不改变其原有的功能。



## 需求

假设你在开发一个 Web 应用，其中需要对外部 API 的网络请求进行管理。每个请求都可能需要执行不同的操作，例如，记录请求的开始和结束时间、添加请求头、记录日志，验证请求等。

### 实例

```php
// 组件接口：定义发送请求的基本行为
interface HttpRequest {
    public function send($url, $data);
}

// 具体组件类：实现基本的 HTTP 请求发送
class SimpleHttpRequest implements HttpRequest {
    public function send($url, $data) {
        echo "Sending request to $url with data: " . json_encode($data) . "\n";
    }
}


// 装饰器类：持有 HttpRequest 的引用，实现 HttpRequest 接口
abstract class HttpRequestDecorator implements HttpRequest {
    protected $httpRequest;

    public function __construct(HttpRequest $httpRequest) {
        $this->httpRequest = $httpRequest;
    }

    public function send($url, $data) {
        $this->httpRequest->send($url, $data);
    }
}

// 具体装饰器类：为请求添加身份验证信息
class AuthenticatedRequest extends HttpRequestDecorator {
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

// 具体装饰器类：记录请求日志
class LoggingRequest extends HttpRequestDecorator {
    public function send($url, $data) {
        echo "Logging request to $url with data: " . json_encode($data) . "\n";
        parent::send($url, $data);
    }
}

// 具体装饰器类：限流
class RateLimitedRequest extends HttpRequestDecorator {
    private static $lastRequestTime = null;
    private $interval; // 请求间隔时间，单位为秒

    public function __construct(HttpRequest $httpRequest, $interval) {
        parent::__construct($httpRequest);
        $this->interval = $interval;
    }

    public function send($url, $data) {
        $now = time();
        if (self::$lastRequestTime && ($now - self::$lastRequestTime) < $this->interval) {
            echo "Request to $url blocked due to rate limiting.\n";
        } else {
            self::$lastRequestTime = $now;
            parent::send($url, $data);
        }
    }
}
```

### 测试

```php

// 使用装饰器组合不同的请求功能，可任意增减
$httpRequest = new SimpleHttpRequest();

// 添加身份验证
$authenticatedRequest = new AuthenticatedRequest($httpRequest, 'my_api_key_123');

// 添加日志记录
$loggingRequest = new LoggingRequest($authenticatedRequest);

// 添加限流功能，限制每次请求间隔至少为 2 秒
$rateLimitedRequest = new RateLimitedRequest($encryptedRequest, 2);

// 模拟发送请求
$rateLimitedRequest->send("https://api.example.com/data", ['param1' => 'value1']);

// 再次发送（限流阻止）
sleep(1); // 等待 1 秒
$rateLimitedRequest->send("https://api.example.com/data", ['param1' => 'value1']);

// 再次发送（限流通过）
sleep(2); // 等待 2 秒
$rateLimitedRequest->send("https://api.example.com/data", ['param1' => 'value1']);

```

### 总结

