<?php

namespace Decorator;

interface HttpRequest
{
    public function send($url, $data);
}