<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\Pay\ApplePayPaymentData;
use Tpay\OpenApi\Model\Fields\Pay\CardOnFile;
use Tpay\OpenApi\Model\Fields\Pay\GooglePayPaymentData;
use Tpay\OpenApi\Model\Fields\Pay\Method;
use Tpay\OpenApi\Model\Identifiers\ChannelId;
use Tpay\OpenApi\Model\Identifiers\GroupId;
use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Model\Objects\Transactions\BlikPaymentData;
use Tpay\OpenApi\Model\Objects\Transactions\CardPaymentData;
use Tpay\OpenApi\Model\Objects\Transactions\Recursive;
use Tpay\OpenApi\Model\Objects\Transactions\TokenPaymentData;

class Pay extends Objects
{
    const OBJECT_FIELDS = [
        'groupId' => GroupId::class,
        'channelId' => ChannelId::class,
        'method' => Method::class,
        'blikPaymentData' => BlikPaymentData::class,
        'cardPaymentData' => CardPaymentData::class,
        'tokenPaymentData' => TokenPaymentData::class,
        'recursive' => Recursive::class,
        'applePayPaymentData' => ApplePayPaymentData::class,
        'googlePayPaymentData' => GooglePayPaymentData::class,
        'cof' => CardOnFile::class,
    ];

    /** @var GroupId */
    public $groupId;

    /** @var ChannelId */
    public $channelId;

    /** @var Method */
    public $method;

    /** @var BlikPaymentData */
    public $blikPaymentData;

    /** @var CardPaymentData */
    public $cardPaymentData;

    /** @var TokenPaymentData */
    public $tokenPaymentData;

    /** @var Recursive */
    public $recursive;

    /** @var ApplePayPaymentData */
    public $applePayPaymentData;

    /** @var GooglePayPaymentData */
    public $googlePayPaymentData;

    /** @var CardOnFile */
    public $cardOnFile;

    public function getRequiredFields()
    {
        return [
            $this->groupId,
        ];
    }
}
