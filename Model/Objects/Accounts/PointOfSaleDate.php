<?php

namespace tpaySDK\Model\Objects\Accounts;

use tpaySDK\Model\Fields\PointOfSaleDate\Create;
use tpaySDK\Model\Fields\PointOfSaleDate\Modification;
use tpaySDK\Model\Objects\Objects;

class PointOfSaleDate extends Objects
{
    const OBJECT_FIELDS = [
        'create' => Create::class,
        'modification' => Modification::class,
    ];

    /**
     * @var Create
     */
    public $create;

    /**
     * @var Modification
     */
    public $modification;
}
