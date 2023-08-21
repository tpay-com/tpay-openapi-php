<?php

namespace Tpay\OpenApi\Model\Objects\Accounts;

use Tpay\OpenApi\Model\Fields\PersonContact\Contact;
use Tpay\OpenApi\Model\Fields\PersonContact\Type;
use Tpay\OpenApi\Model\Objects\Objects;

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
