<?php

namespace Tpay\Model\Objects\Accounts;

use Tpay\Model\Fields\PointOfSaleDate\Create;
use Tpay\Model\Fields\PointOfSaleDate\Modification;
use Tpay\Model\Objects\Objects;

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
