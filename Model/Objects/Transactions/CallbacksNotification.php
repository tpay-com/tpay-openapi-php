<?php
namespace tpaySDK\Model\Objects\Transactions;

use tpaySDK\Model\Fields\Person\Email;
use tpaySDK\Model\Fields\PointOfSale\Url;
use tpaySDK\Model\Objects\Objects;

class CallbacksNotification extends Objects
{
    const OBJECT_FIELDS = [
        'url' => Url::class,
        'email' => Email::class,
    ];

    /**
     * @var Url
     */
    public $url;

    /**
     * @var Email
     */
    public $email;

}
