<?php

declare(strict_types=1);

namespace Tpay\OpenApi\Model\Objects\Recurring;

use Tpay\OpenApi\Model\Fields\Recurring\Schedule\Interval;
use Tpay\OpenApi\Model\Fields\Recurring\Schedule\IntervalType;
use Tpay\OpenApi\Model\Objects\Objects;

class RetryInterval extends Objects
{
    const OBJECT_FIELDS = [
        'value' => Interval::class,
        'unit' => IntervalType::class,
    ];

    /** @var Interval */
    public $value;

    /** @var IntervalType */
    public $unit;

    public function getRequiredFields()
    {
        return [
            $this->value,
            $this->unit,
        ];
    }
}
