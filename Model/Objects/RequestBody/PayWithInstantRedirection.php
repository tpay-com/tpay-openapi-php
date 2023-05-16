<?php
namespace tpaySDK\Model\Objects\RequestBody;

use tpaySDK\Model\Fields\Pay\ApplePayPaymentData;
use tpaySDK\Model\Fields\Pay\Method;
use tpaySDK\Model\Identifiers\ChannelId;
use tpaySDK\Model\Objects\Objects;
use tpaySDK\Model\Objects\Transactions\BlikPaymentData;
use tpaySDK\Model\Objects\Transactions\CardPaymentData;
use tpaySDK\Model\Objects\Transactions\Recursive;

class PayWithInstantRedirection extends Objects
{
    const OBJECT_FIELDS = [
        'channelId' => ChannelId::class,
        'method' => Method::class,
        'blikPaymentData' => BlikPaymentData::class,
        'cardPaymentData' => CardPaymentData::class,
        'recursive' => Recursive::class,
        'applePayPaymentData' => ApplePayPaymentData::class
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
