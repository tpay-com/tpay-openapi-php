<?php

namespace Tpay\OpenApi\Webhook;

use Tpay\OpenApi\Manager\Manager;

class Notification
{
    /** @var Manager */
    protected $Manager;

    public function __construct()
    {
        $this->Manager = new Manager();
    }
}
