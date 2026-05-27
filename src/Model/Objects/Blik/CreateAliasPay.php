<?php

namespace Tpay\OpenApi\Model\Objects\Blik;

use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Model\Objects\Transactions\BlikPaymentData;

class CreateAliasPay extends Objects
{
    const OBJECT_FIELDS = [
        'blikPaymentData' => BlikPaymentData::class,
    ];

    /** @var BlikPaymentData */
    public $blikPaymentData;

    public function getRequiredFields()
    {
        return [
            $this->blikPaymentData,
        ];
    }
}
