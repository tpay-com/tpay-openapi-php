<?php

namespace tpaySDK\Webhook;

use tpaySDK\Manager\Manager;

class Notification
{
    protected $Manager;

    public function __construct()
    {
        $this->Manager = new Manager();
    }
}
