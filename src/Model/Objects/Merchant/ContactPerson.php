<?php

namespace Tpay\OpenApi\Model\Objects\Merchant;

use Tpay\OpenApi\Model\Fields\Person\Name;
use Tpay\OpenApi\Model\Fields\Person\Surname;
use Tpay\OpenApi\Model\Fields\PersonContact\Email;
use Tpay\OpenApi\Model\Fields\PersonContact\Phone;
use Tpay\OpenApi\Model\Objects\Objects;

class ContactPerson extends Objects
{
    const OBJECT_FIELDS = [
        'name' => Name::class,
        'surname' => Surname::class,
        'phone' => Phone::class,
        'email' => Email::class,
    ];

    /** @var Name */
    public $name;

    /** @var Surname */
    public $surname;

    /** @var Phone */
    public $phone;

    /** @var Email */
    public $email;
}
