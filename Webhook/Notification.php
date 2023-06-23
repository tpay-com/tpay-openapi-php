<?php
namespace tpaySDK\Webhook;

use tpaySDK\Dictionary\NotificationsIP;
use tpaySDK\Manager\Manager;
use tpaySDK\Utilities\Logger;
use tpaySDK\Utilities\ServerValidator;
use tpaySDK\Utilities\TpayException;
use tpaySDK\Utilities\Util;

class Notification
{
    protected $Manager;

    public function __construct()
    {
        $this->Manager = new Manager();
    }
}
