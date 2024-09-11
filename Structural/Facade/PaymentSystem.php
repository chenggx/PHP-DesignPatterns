<?php

namespace Facade;

class PaymentSystem
{
    public function processPayment($orderId, $amount)
    {
        // 模拟支付处理
        echo "Processing payment for order $orderId, amount $amount...\n";
        return true;
    }
}