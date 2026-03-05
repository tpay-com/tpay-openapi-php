<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Model\Objects\Recurring\PaymentInstrument;

class UpdatePaymentInstrument extends Objects
{
    const OBJECT_FIELDS = [
        'paymentInstrument' => PaymentInstrument::class,
    ];

    /** @var PaymentInstrument */
    public $paymentInstrument;

    public function getRequiredFields()
    {
        return [
            $this->paymentInstrument,
        ];
    }
}
