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
    public $requestBody;

    protected $secureIP = NotificationsIP::SECURE_IPS;

    protected $validateServerIP = true;

    protected $validateForwardedIP = false;

    protected $Manager;

    public function __construct()
    {
        $this->Manager = new Manager;
    }

    /**
     * Check cURL request from Tpay server after payment.
     * This method check server ip, required fields and checksum sent by payment server.
     * Display information to prevent sending repeated notifications.
     * @param string $response Print response to Tpay server.
     * If empty, then you have to print it somewhere else to avoid rescheduling notifications
     * @throws TpayException
     */
    public function checkNotification($response = '')
    {
        if ($this->validateServerIP === true && $this->isTpayServer() === false) {
            throw new TpayException('Request is not from secure server');
        }
        $requestBody = $this->requestBody;
        Logger::log('Notification', 'POST params:'.PHP_EOL.json_encode($_POST));
        foreach ($_POST as $parameter => $value) {
            if (isset($requestBody->$parameter)) {
                $_POST[$parameter] = Util::cast($value, $requestBody->$parameter->getType());
            }
        }
        $this->Manager
            ->setRequestBody($requestBody)
            ->setFields($_POST);
        $notification = $this->Manager->getRequestBody();
        if (!empty($response) && is_string($response)) {
            echo $response;
        }

        return $notification;
    }

    /**
     * Validation of Tpay server ip is mandatory in production mode.
     * @param boolean $validateServerIP
     * @return Notification
     */
    public function setValidateServerIP($validateServerIP)
    {
        $this->validateServerIP = $validateServerIP;

        return $this;
    }

    /**
     * Set validation of Tpay server IP in forwarded IP table - enabling this is not recommended due to security risk
     * @param boolean $validateForwardedIP
     * @return Notification
     */
    public function setValidateForwardedIP($validateForwardedIP)
    {
        $this->validateForwardedIP = $validateForwardedIP;

        return $this;
    }

    protected function isTpayServer()
    {
        return (new ServerValidator($this->validateServerIP, $this->validateForwardedIP, $this->secureIP))->isValid();
    }

}
