<?php

namespace Facade;

class InventorySystem
{
    public function checkStock($productId, $quantity)
    {
        // 假设库存充足，返回true
        echo "Checking stock for product $productId...\n";
        return true;
    }
}