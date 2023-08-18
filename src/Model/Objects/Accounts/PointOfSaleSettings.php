<?php

namespace Tpay\Model\Objects\Accounts;

use Tpay\Model\Fields\PointOfSaleSettings\ConfirmationCode;
use Tpay\Model\Fields\PointOfSaleSettings\IsTestMode;
use Tpay\Model\Objects\Objects;

class PointOfSaleSettings extends Objects
{
    const OBJECT_FIELDS = [
        'confirmationCode' => ConfirmationCode::class,
        'isTestMode' => IsTestMode::class,
    ];

    /**
     * @var ConfirmationCode
     */
    public $confirmationCode;

    /**
     * @var IsTestMode
     */
    public $isTestMode;
}
