<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Fields\Beneficiary\AccountNumber;
use Tpay\OpenApi\Model\Fields\Payer\Name;
use Tpay\OpenApi\Model\Objects\Accounts\Address;
use Tpay\OpenApi\Model\Objects\Objects;

class VerificationData extends Objects
{
    const OBJECT_FIELDS = [
        'name' => Name::class,
        'address' => Address::class,
        'bankAccountNumber' => AccountNumber::class,
    ];

    /** @var Name */
    public $name;

    /** @var Address */
    public $address;

    /** @var AccountNumber */
    public $bankAccountNumber;
}
