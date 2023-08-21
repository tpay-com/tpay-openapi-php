<?php

namespace Tpay\Model\Objects\Transactions;

use Tpay\Model\Objects\Objects;

class Verification extends Objects
{
    const OBJECT_FIELDS = [
        'data' => [VerificationData::class],
    ];

    /**
     * @var VerificationData
     */
    public $data;
}
