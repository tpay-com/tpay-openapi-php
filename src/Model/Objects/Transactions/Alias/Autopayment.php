<?php

namespace Tpay\OpenApi\Model\Objects\Transactions\Alias;

use Tpay\OpenApi\Model\Fields\BlikPaymentData\Autopayment\Currency;
use Tpay\OpenApi\Model\Fields\BlikPaymentData\Autopayment\Date;
use Tpay\OpenApi\Model\Fields\BlikPaymentData\Autopayment\Frequency;
use Tpay\OpenApi\Model\Fields\BlikPaymentData\Autopayment\Model;
use Tpay\OpenApi\Model\Fields\BlikPaymentData\Autopayment\SingleLimitAmount;
use Tpay\OpenApi\Model\Fields\BlikPaymentData\Autopayment\TotalLimitAmount;
use Tpay\OpenApi\Model\Fields\Recursive\ExpirationDate;
use Tpay\OpenApi\Model\Objects\Objects;

class Autopayment extends Objects
{
    const OBJECT_FIELDS = [
        'model' => Model::class,
        'frequency' => Frequency::class,
        'singleLimitAmount' => SingleLimitAmount::class,
        'totalLimitAmount' => TotalLimitAmount::class,
        'currency' => Currency::class,
        'initDate' => Date::class,
        'expirationDate' => Date::class,
    ];

    /** @var Model */
    public $model;
    /** @var Frequency */
    public $frequency;
    /** @var SingleLimitAmount */
    public $singleLimitAmount;
    /** @var TotalLimitAmount */
    public $totalLimitAmount;
    /** @var Currency */
    public $currency;
    /** @var Date */
    public $initDate;
    /** @var ExpirationDate */
    public $expirationDate;

}
