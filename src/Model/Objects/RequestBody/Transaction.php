<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\Transaction\Amount;
use Tpay\OpenApi\Model\Fields\Transaction\Description;
use Tpay\OpenApi\Model\Fields\Transaction\HiddenDescription;
use Tpay\OpenApi\Model\Fields\Transaction\Lang;
use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Model\Objects\Transactions\Callbacks;
use Tpay\OpenApi\Model\Objects\Transactions\Payer;

class Transaction extends Objects
{
    const OBJECT_FIELDS = [
        'amount' => Amount::class,
        'description' => Description::class,
        'hiddenDescription' => HiddenDescription::class,
        'lang' => Lang::class,
        'pay' => Pay::class,
        'payer' => Payer::class,
        'callbacks' => Callbacks::class,
    ];

    /** @var Amount */
    public $amount;

    /** @var Description */
    public $description;

    /** @var HiddenDescription */
    public $hiddenDescription;

    /** @var Lang */
    public $lang;

    /** @var Pay */
    public $pay;

    /** @var Payer */
    public $payer;

    /** @var Callbacks */
    public $callbacks;

    public function getRequiredFields()
    {
        return [
            $this->amount,
            $this->description,
            $this->payer,
        ];
    }
}
