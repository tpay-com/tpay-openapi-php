<?php

namespace Tpay\Model\Objects\Transactions;

use Tpay\Model\Fields\Recursive\ExpirationDate;
use Tpay\Model\Fields\Recursive\Period;
use Tpay\Model\Fields\Recursive\Quantity;
use Tpay\Model\Fields\Recursive\Type;
use Tpay\Model\Objects\Objects;

class Recursive extends Objects
{
    const OBJECT_FIELDS = [
        'period' => Period::class,
        'quantity' => Quantity::class,
        'type' => Type::class,
        'expirationDate' => ExpirationDate::class,
    ];

    /**
     * @var Period
     */
    public $period;

    /**
     * @var Quantity
     */
    public $quantity;

    /**
     * @var Type
     */
    public $type;

    /**
     * @var ExpirationDate
     */
    public $expirationDate;

    public function getRequiredFields()
    {
        return [
            $this->period,
            $this->quantity,
            $this->type,
            $this->expirationDate,
        ];
    }
}
