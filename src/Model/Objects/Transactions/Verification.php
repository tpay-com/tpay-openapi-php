<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Objects\Objects;

class Verification extends Objects
{
    const OBJECT_FIELDS = [
        'data' => [VerificationData::class],
    ];

    /** @var VerificationData */
    public $data;
}
