<?php

namespace tpaySDK\Model\Objects\Transactions;

use tpaySDK\Model\Fields\Address\City;
use tpaySDK\Model\Fields\Address\Phone;
use tpaySDK\Model\Fields\Address\PostalCode;
use tpaySDK\Model\Fields\Payer\Address;
use tpaySDK\Model\Fields\Payer\Name;
use tpaySDK\Model\Fields\Person\Email;
use tpaySDK\Model\Fields\Transaction\Country;
use tpaySDK\Model\Objects\Objects;

class Payer extends Objects
{
    const OBJECT_FIELDS = [
        'email' => Email::class,
        'name' => Name::class,
        'phone' => Phone::class,
        'address' => Address::class,
        'code' => PostalCode::class,
        'city' => City::class,
        'country' => Country::class,
    ];

    /**
     * @var Email
     */
    public $email;

    /**
     * @var Name
     */
    public $name;

    /**
     * @var Phone
     */
    public $phone;

    /**
     * @var Address
     */
    public $address;

    /**
     * @var PostalCode
     */
    public $code;

    /**
     * @var City
     */
    public $city;

    /**
     * @var Country
     */
    public $country;

    public function getRequiredFields()
    {
        return [
            $this->email,
            $this->name,
        ];
    }
}
