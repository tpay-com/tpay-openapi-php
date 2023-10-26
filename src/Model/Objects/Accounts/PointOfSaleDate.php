<?php

namespace Tpay\OpenApi\Model\Objects\Accounts;

use Tpay\OpenApi\Model\Fields\PointOfSaleDate\Create;
use Tpay\OpenApi\Model\Fields\PointOfSaleDate\Modification;
use Tpay\OpenApi\Model\Objects\Objects;

class PointOfSaleDate extends Objects
{
    const OBJECT_FIELDS = [
        'create' => Create::class,
        'modification' => Modification::class,
    ];

    /** @var Create */
    public $create;

    /** @var Modification */
    public $modification;
}
