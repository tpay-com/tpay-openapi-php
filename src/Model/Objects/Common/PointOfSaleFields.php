<?php

namespace Tpay\OpenApi\Model\Objects\Common;

use Tpay\OpenApi\Model\Fields\Address\Description;
use Tpay\OpenApi\Model\Fields\Address\FriendlyName;
use Tpay\OpenApi\Model\Fields\PointOfSale\Name;
use Tpay\OpenApi\Model\Fields\PointOfSale\Url;
use Tpay\OpenApi\Model\Identifiers\AccountId;
use Tpay\OpenApi\Model\Identifiers\PosId;

class PointOfSaleFields
{
    const COMMON_FIELDS = [
        'posId' => PosId::class,
        'accountId' => AccountId::class,
        'name' => Name::class,
        'friendlyName' => FriendlyName::class,
        'description' => Description::class,
        'url' => Url::class,
    ];
}
