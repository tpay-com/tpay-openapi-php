<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Fields\Alias\Key;
use Tpay\OpenApi\Model\Fields\Alias\Label;
use Tpay\OpenApi\Model\Fields\Alias\Type;
use Tpay\OpenApi\Model\Fields\Alias\Value;
use Tpay\OpenApi\Model\Fields\BlikPaymentData\NoDelay;
use Tpay\OpenApi\Model\Fields\Boolean;
use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Model\Objects\Transactions\Alias\Autopayment;

class Alias extends Objects
{
    const OBJECT_FIELDS = [
        'value' => Value::class,
        'type' => Type::class,
        'label' => Label::class,
        'key' => Key::class,
        'autopayment' => Autopayment::class,
        'noDelay' => Boolean::class
    ];

    /** @var Value */
    public $value;

    /** @var Type */
    public $type;

    /** @var Label */
    public $label;

    /** @var Key */
    public $key;
    /** @var Autopayment */
    public $autopayment;

    /** @var NoDelay */
    public $noDelay;

    public function getRequiredFields()
    {
        return [
            $this->value,
            $this->type,
        ];
    }
}
