<?php
namespace tpaySDK\Model\Objects\Transactions;

use tpaySDK\Model\Objects\Objects;

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
