<?php
namespace tpaySDK\Model\Objects\Transactions;

use tpaySDK\Model\Fields\Beneficiary\AccountNumber;
use tpaySDK\Model\Fields\Payer\Name;
use tpaySDK\Model\Objects\Accounts\Address;
use tpaySDK\Model\Objects\Objects;

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
