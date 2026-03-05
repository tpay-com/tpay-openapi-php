<?php

namespace Tpay\OpenApi\Model\Objects\Recurring;

use Tpay\OpenApi\Model\Fields\Recurring\PaymentInstrument\PaymentType;
use Tpay\OpenApi\Model\Fields\Recurring\PaymentInstrument\Value;
use Tpay\OpenApi\Model\Objects\Objects;

class PaymentInstrument extends Objects
{
    const OBJECT_FIELDS = [
        'paymentType' => PaymentType::class,
        'value' => Value::class,
    ];

    /** @var PaymentType */
    public $paymentType;

    /** @var Value */
    public $value;

    public function getRequiredFields()
    {
        return [
            $this->paymentType,
            $this->value,
        ];
    }
}
