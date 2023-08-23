<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Fields\Address\City;
use Tpay\OpenApi\Model\Fields\Address\Phone;
use Tpay\OpenApi\Model\Fields\Address\PostalCode;
use Tpay\OpenApi\Model\Fields\Payer\Address;
use Tpay\OpenApi\Model\Fields\Payer\Name;
use Tpay\OpenApi\Model\Fields\Person\Email;
use Tpay\OpenApi\Model\Fields\Transaction\Country;
use Tpay\OpenApi\Model\Objects\Objects;

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

    /** @var Email */
    public $email;

    /** @var Name */
    public $name;

    /** @var Phone */
    public $phone;

    /** @var Address */
    public $address;

    /** @var PostalCode */
    public $code;

    /** @var City */
    public $city;

    /** @var Country */
    public $country;

    public function getRequiredFields()
    {
        return [
            $this->email,
            $this->name,
        ];
    }
}
