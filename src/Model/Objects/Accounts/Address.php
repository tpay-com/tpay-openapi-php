<?php

namespace Tpay\Model\Objects\Accounts;

use Tpay\Model\Fields\Address\City;
use Tpay\Model\Fields\Address\Country;
use Tpay\Model\Fields\Address\FriendlyName;
use Tpay\Model\Fields\Address\HouseNumber;
use Tpay\Model\Fields\Address\IsCorrespondence;
use Tpay\Model\Fields\Address\IsInvoice;
use Tpay\Model\Fields\Address\IsMain;
use Tpay\Model\Fields\Address\Name;
use Tpay\Model\Fields\Address\Phone;
use Tpay\Model\Fields\Address\PostalCode;
use Tpay\Model\Fields\Address\RoomNumber;
use Tpay\Model\Fields\Address\Street;
use Tpay\Model\Objects\Objects;

class Address extends Objects
{
    const OBJECT_FIELDS = [
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
        'roomNumber' => RoomNumber::class,
        'street' => Street::class,
    ];

    /**
     * @var City
     */
    public $city;

    /**
     * @var Country
     */
    public $country;

    /**
     * @var FriendlyName
     */
    public $friendlyName;

    /**
     * @var HouseNumber
     */
    public $houseNumber;

    /**
     * @var IsCorrespondence
     */
    public $isCorrespondence;

    /**
     * @var IsInvoice
     */
    public $isInvoice;

    /**
     * @var IsMain
     */
    public $isMain;

    /**
     * @var Name
     */
    public $name;

    /**
     * @var Phone
     */
    public $phone;

    /**
     * @var PostalCode
     */
    public $postalCode;

    /**
     * @var RoomNumber
     */
    public $roomNumber;

    /**
     * @var Street
     */
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
