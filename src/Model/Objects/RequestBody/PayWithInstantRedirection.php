<?php

namespace Tpay\Model\Objects\RequestBody;

use Tpay\Model\Fields\Pay\ApplePayPaymentData;
use Tpay\Model\Fields\Pay\Method;
use Tpay\Model\Identifiers\ChannelId;
use Tpay\Model\Objects\Objects;
use Tpay\Model\Objects\Transactions\BlikPaymentData;
use Tpay\Model\Objects\Transactions\CardPaymentData;
use Tpay\Model\Objects\Transactions\Recursive;

class PayWithInstantRedirection extends Objects
{
    const OBJECT_FIELDS = [
        'channelId' => ChannelId::class,
        'method' => Method::class,
        'blikPaymentData' => BlikPaymentData::class,
        'cardPaymentData' => CardPaymentData::class,
        'recursive' => Recursive::class,
        'applePayPaymentData' => ApplePayPaymentData::class,
    ];

    /**
     * @var ChannelId
     */
    public $channelId;

    /**
     * @var Method
     */
    public $method;

    /**
     * @var BlikPaymentData
     */
    public $blikPaymentData;

    /**
     * @var CardPaymentData
     */
    public $cardPaymentData;

    /**
     * @var Recursive
     */
    public $recursive;

    /**
     * @var ApplePayPaymentData
     */
    public $applePayPaymentData;

    public function getRequiredFields()
    {
        return [
            $this->channelId,
        ];
    }
}
