<?php

namespace tpaySDK\Model\Objects\Accounts;

use tpaySDK\Model\Fields\Address\City;
use tpaySDK\Model\Fields\Address\Country;
use tpaySDK\Model\Fields\Address\FriendlyName;
use tpaySDK\Model\Fields\Address\HouseNumber;
use tpaySDK\Model\Fields\Address\IsCorrespondence;
use tpaySDK\Model\Fields\Address\IsInvoice;
use tpaySDK\Model\Fields\Address\IsMain;
use tpaySDK\Model\Fields\Address\Name;
use tpaySDK\Model\Fields\Address\Phone;
use tpaySDK\Model\Fields\Address\PostalCode;
use tpaySDK\Model\Fields\Address\RoomNumber;
use tpaySDK\Model\Fields\Address\Street;
use tpaySDK\Model\Objects\Objects;

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
