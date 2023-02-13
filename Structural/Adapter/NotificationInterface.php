<?php

namespace Structural\Adapter\NotificationInterface;

interface NotificationInterface
{
    public function send($title, $message);
}