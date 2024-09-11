<?php

use Facade\OrderFacade;

require '../../vendor/autoload.php';

$orderFacade = new OrderFacade();
$orderFacade->placeOrder(1, 101, 2, 299.99);