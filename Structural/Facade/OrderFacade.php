<?php

namespace Facade;

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