<?php

namespace Tpay\OpenApi\Model\Objects\Recurring;

use Tpay\OpenApi\Model\Fields\Recurring\Schedule\Amount;
use Tpay\OpenApi\Model\Fields\Recurring\Schedule\ChargeCount;
use Tpay\OpenApi\Model\Fields\Recurring\Schedule\Currency;
use Tpay\OpenApi\Model\Fields\Recurring\Schedule\FirstChargeDate;
use Tpay\OpenApi\Model\Fields\Recurring\Schedule\Interval;
use Tpay\OpenApi\Model\Fields\Recurring\Schedule\IntervalType;
use Tpay\OpenApi\Model\Objects\Objects;

class Schedule extends Objects
{
    const OBJECT_FIELDS = [
        'amount' => Amount::class,
        'currency' => Currency::class,
        'firstChargeDate' => FirstChargeDate::class,
        'interval' => Interval::class,
        'intervalType' => IntervalType::class,
        'chargeCount' => ChargeCount::class,
    ];

    /** @var Amount */
    public $amount;

    /** @var Currency */
    public $currency;

    /** @var FirstChargeDate */
    public $firstChargeDate;

    /** @var Interval */
    public $interval;

    /** @var IntervalType */
    public $intervalType;

    /** @var ChargeCount */
    public $chargeCount;

    public function getRequiredFields()
    {
        return [
            $this->amount,
            $this->currency,
            $this->firstChargeDate,
            $this->interval,
            $this->intervalType,
        ];
    }
}
