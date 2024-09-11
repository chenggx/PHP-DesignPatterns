**外观模式（Facade Pattern）**
是一种结构型设计模式，通过引入一个外观类，为复杂的子系统提供一个简单的接口，从而简化客户端对子系统的访问。

## 需求

电商系统中的订单处理，设计三个子系统，库存系统：检查商品库存。订单系统：处理订单创建。支付系统：处理支付。通过外观模式，客户端不用知道子系统有哪些就能实现订单创建。

### 实例

```php
// 子系统类：库存系统
class InventorySystem
{
    public function checkStock($productId, $quantity)
    {
        // 假设库存充足，返回true
        echo "Checking stock for product $productId...\n";
        return true;
    }
}

// 子系统类：订单系统
class OrderSystem
{
    public function createOrder($userId, $productId, $quantity)
    {
        // 模拟订单创建
        echo "Creating order for user $userId, product $productId, quantity $quantity...\n";
        return rand(1000, 9999);  // 返回订单ID
    }
}

// 子系统类：支付系统
class PaymentSystem
{
    public function processPayment($orderId, $amount)
    {
        // 模拟支付处理
        echo "Processing payment for order $orderId, amount $amount...\n";
        return true;
    }
}

// 外观类：订单处理外观
class OrderFacade
{
    protected $inventorySystem;
    protected $orderSystem;
    protected $paymentSystem;

    public function __construct()
    {
        $this->inventorySystem = new InventorySystem();
        $this->orderSystem = new OrderSystem();
        $this->paymentSystem = new PaymentSystem();
    }

    // 提供简化的接口处理订单
    public function placeOrder($userId, $productId, $quantity, $amount)
    {
        // 第一步：检查库存
        if (!$this->inventorySystem->checkStock($productId, $quantity)) {
            echo "Insufficient stock for product $productId.\n";
            return false;
        }

        // 第二步：创建订单
        $orderId = $this->orderSystem->createOrder($userId, $productId, $quantity);

        // 第三步：处理支付
        if ($this->paymentSystem->processPayment($orderId, $amount)) {
            echo "Order placed successfully! Order ID: $orderId\n";
            return $orderId;
        }

        echo "Payment failed for order $orderId.\n";
        return false;
    }
}
```

### 测试

```php
$orderFacade = new OrderFacade();
$orderFacade->placeOrder(1, 101, 2, 299.99);
```

### 总结

该设计模式比较简单，只是将多个子系统封装成一个外观类，客户端只需要调用外观类的方法，而不需要知道子系统的细节。但实现开发中经常会和其他设计模式共用，
例如 laravel 中的各种 facade，比如 Illuminate\Support\Facades\DB， Illuminate\Support\Facades\Cache 等。