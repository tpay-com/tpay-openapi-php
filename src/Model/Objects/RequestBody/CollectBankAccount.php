<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\Collect\AccountNumber;
use Tpay\OpenApi\Model\Fields\Collect\AdditionalInformation;
use Tpay\OpenApi\Model\Fields\Collect\OwnerName;
use Tpay\OpenApi\Model\Objects\Objects;

class CollectBankAccount extends Objects
{
    const OBJECT_FIELDS = [
        'accountNumber' => AccountNumber::class,
        'ownerName' => OwnerName::class,
        'additionalInformation' => AdditionalInformation::class,
    ];

    public $accountNumber;

    public $ownerName;

    public $additionalInformation;

    public function getRequiredFields()
    {
        return [
            $this->accountNumber,
            $this->ownerName,
            $this->additionalInformation,
        ];
    }
}
