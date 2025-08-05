<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Fields\Collect\Account;
use Tpay\OpenApi\Model\Fields\Collect\Receiver;
use Tpay\OpenApi\Model\Objects\Objects;

class Collect extends Objects
{
    const OBJECT_FIELDS = [
        'account' => Account::class,
        'receiver' => Receiver::class,
    ];

    /** @var Account */
    public $account;

    /** @var Receiver */
    public $receiver;

    public function getRequiredFields()
    {
        return [
            $this->account,
            $this->receiver,
        ];
    }
}
