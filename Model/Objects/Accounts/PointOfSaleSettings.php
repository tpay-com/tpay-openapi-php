<?php
namespace tpaySDK\Model\Objects\Accounts;

use tpaySDK\Model\Fields\PointOfSaleSettings\ConfirmationCode;
use tpaySDK\Model\Fields\PointOfSaleSettings\IsTestMode;
use tpaySDK\Model\Objects\Objects;

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
