<?php

namespace Tpay\Model\Objects\Accounts;

use Tpay\Model\Fields\PersonContact\Contact;
use Tpay\Model\Fields\PersonContact\Type;
use Tpay\Model\Objects\Objects;

class PersonContact extends Objects
{
    const OBJECT_FIELDS = [
        'type' => Type::class,
        'contact' => Contact::class,
    ];

    /**
     * @var Type
     */
    public $type;

    /**
     * @var Contact
     */
    public $contact;
}
