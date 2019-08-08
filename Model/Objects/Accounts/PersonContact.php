<?php
namespace tpaySDK\Model\Objects\Accounts;

use tpaySDK\Model\Fields\PersonContact\Contact;
use tpaySDK\Model\Fields\PersonContact\Type;
use tpaySDK\Model\Objects\Objects;

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
