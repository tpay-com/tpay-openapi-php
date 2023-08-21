<?php

namespace Tpay\Webhook;

use Tpay\Manager\Manager;

class Notification
{
    protected $Manager;

    public function __construct()
    {
        $this->Manager = new Manager();
    }
}
