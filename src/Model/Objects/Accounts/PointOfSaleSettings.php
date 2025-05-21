<?php

namespace Tpay\OpenApi\Model\Objects\Accounts;

use Tpay\OpenApi\Model\Fields\PointOfSaleSettings\ConfirmationCode;
use Tpay\OpenApi\Model\Fields\PointOfSaleSettings\IsTestMode;
use Tpay\OpenApi\Model\Objects\Objects;

class PointOfSaleSettings extends Objects
{
    const OBJECT_FIELDS = [
        'confirmationCode' => ConfirmationCode::class,
        'isTestMode' => IsTestMode::class,
    ];

    /** @var ConfirmationCode */
    public $confirmationCode;

    /** @var IsTestMode */
    public $isTestMode;
}
