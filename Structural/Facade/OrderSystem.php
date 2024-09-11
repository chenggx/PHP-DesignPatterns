<?php

namespace Facade;

class OrderSystem
{
    public function createOrder($userId, $productId, $quantity)
    {
        // 模拟订单创建
        echo "Creating order for user $userId, product $productId, quantity $quantity...\n";
        return rand(1000, 9999);  // 返回订单ID
    }
}