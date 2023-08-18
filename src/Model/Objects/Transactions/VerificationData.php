<?php

namespace Tpay\Model\Objects\Transactions;

use Tpay\Model\Fields\Beneficiary\AccountNumber;
use Tpay\Model\Fields\Payer\Name;
use Tpay\Model\Objects\Accounts\Address;
use Tpay\Model\Objects\Objects;

class VerificationData extends Objects
{
    const OBJECT_FIELDS = [
        'name' => Name::class,
        'address' => Address::class,
        'bankAccountNumber' => AccountNumber::class,
    ];

    /**
     * @var Name
     */
    public $name;

    /**
     * @var Address
     */
    public $address;

    /**
     * @var AccountNumber
     */
    public $bankAccountNumber;
}
