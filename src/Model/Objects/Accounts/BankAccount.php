<?php

namespace Tpay\OpenApi\Model\Objects\Accounts;

use Tpay\OpenApi\Model\Fields\Account\AccountNo;
use Tpay\OpenApi\Model\Fields\Account\AccountType;
use Tpay\OpenApi\Model\Fields\Account\BankName;
use Tpay\OpenApi\Model\Fields\Account\CountryCode;
use Tpay\OpenApi\Model\Fields\Account\Currency;
use Tpay\OpenApi\Model\Fields\Account\OwnerAddress;
use Tpay\OpenApi\Model\Fields\Account\OwnerName;
use Tpay\OpenApi\Model\Objects\Objects;

class BankAccount extends Objects
{
    public const OBJECT_FIELDS = [
        'accountNo' => AccountNo::class,
        'bankName' => BankName::class,
        'ownerName' => OwnerName::class,
        'ownerAddress' => OwnerAddress::class,
        'currency' => Currency::class,
        'countryCode' => CountryCode::class,
        'accountType' => AccountType::class,
    ];

    /** @var AccountNo */
    public $accountNo;

    /** @var BankName */
    public $bankName;

    /** @var OwnerName */
    public $ownerName;

    /** @var OwnerAddress */
    public $ownerAddress;

    /** @var Currency */
    public $currency;

    /** @var CountryCode */
    public $countryCode;

    /** @var AccountType */
    public $accountType;

    public function getRequiredFields()
    {
        return [
            $this->accountNo,
            $this->bankName,
            $this->ownerName,
            $this->ownerAddress,
        ];
    }
}
