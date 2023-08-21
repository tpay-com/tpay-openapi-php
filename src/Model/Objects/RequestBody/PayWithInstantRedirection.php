<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\Pay\ApplePayPaymentData;
use Tpay\OpenApi\Model\Fields\Pay\Method;
use Tpay\OpenApi\Model\Identifiers\ChannelId;
use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Model\Objects\Transactions\BlikPaymentData;
use Tpay\OpenApi\Model\Objects\Transactions\CardPaymentData;
use Tpay\OpenApi\Model\Objects\Transactions\Recursive;

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
