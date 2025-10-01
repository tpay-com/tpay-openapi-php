<?php

namespace Tpay\OpenApi\Model\Objects\Common;

use Tpay\OpenApi\Model\Fields\Address\City;
use Tpay\OpenApi\Model\Fields\Address\Country;
use Tpay\OpenApi\Model\Fields\Address\FriendlyName;
use Tpay\OpenApi\Model\Fields\Address\HouseNumber;
use Tpay\OpenApi\Model\Fields\Address\IsCorrespondence;
use Tpay\OpenApi\Model\Fields\Address\IsInvoice;
use Tpay\OpenApi\Model\Fields\Address\IsMain;
use Tpay\OpenApi\Model\Fields\Address\Name;
use Tpay\OpenApi\Model\Fields\Address\Phone;
use Tpay\OpenApi\Model\Fields\Address\PostalCode;
use Tpay\OpenApi\Model\Fields\Address\Street;

class AddressFields
{
    const COMMON_FIELDS = [
        'city' => City::class,
        'country' => Country::class,
        'friendlyName' => FriendlyName::class,
        'houseNumber' => HouseNumber::class,
        'isCorrespondence' => IsCorrespondence::class,
        'isInvoice' => IsInvoice::class,
        'isMain' => IsMain::class,
        'name' => Name::class,
        'phone' => Phone::class,
        'postalCode' => PostalCode::class,
        'street' => Street::class,
    ];
}
