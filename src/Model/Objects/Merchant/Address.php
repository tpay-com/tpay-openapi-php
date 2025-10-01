<?php

namespace Tpay\OpenApi\Model\Objects\Merchant;

use Tpay\OpenApi\Model\Fields\Address\City;
use Tpay\OpenApi\Model\Fields\Address\Country;
use Tpay\OpenApi\Model\Fields\Address\FlatNumber;
use Tpay\OpenApi\Model\Fields\Address\FriendlyName;
use Tpay\OpenApi\Model\Fields\Address\HouseNumber;
use Tpay\OpenApi\Model\Fields\Address\IsCorrespondence;
use Tpay\OpenApi\Model\Fields\Address\IsInvoice;
use Tpay\OpenApi\Model\Fields\Address\IsMain;
use Tpay\OpenApi\Model\Fields\Address\Name;
use Tpay\OpenApi\Model\Fields\Address\Phone;
use Tpay\OpenApi\Model\Fields\Address\PostalCode;
use Tpay\OpenApi\Model\Fields\Address\Street;
use Tpay\OpenApi\Model\Objects\Objects;

class Address extends Objects
{
    const OBJECT_FIELDS = [
        'city' => City::class,
        'country' => Country::class,
        'friendlyName' => FriendlyName::class,
        'houseNumber' => HouseNumber::class,
        'flatNumber' => FlatNumber::class,
        'isCorrespondence' => IsCorrespondence::class,
        'isInvoice' => IsInvoice::class,
        'isMain' => IsMain::class,
        'name' => Name::class,
        'phone' => Phone::class,
        'postalCode' => PostalCode::class,
        'street' => Street::class,
    ];

    /** @var City */
    public $city;

    /** @var Country */
    public $country;

    /** @var FriendlyName */
    public $friendlyName;

    /** @var HouseNumber */
    public $houseNumber;

    /** @var FlatNumber */
    public $flatNumber;

    /** @var IsCorrespondence */
    public $isCorrespondence;

    /** @var IsInvoice */
    public $isInvoice;

    /** @var IsMain */
    public $isMain;

    /** @var Name */
    public $name;

    /** @var Phone */
    public $phone;

    /** @var PostalCode */
    public $postalCode;

    /** @var Street */
    public $street;

    public function getRequiredFields()
    {
        return [
            $this->friendlyName,
            $this->name,
            $this->street,
            $this->houseNumber,
            $this->postalCode,
            $this->city,
            $this->country,
        ];
    }
}
