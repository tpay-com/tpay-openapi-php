<?php

namespace Tpay\Model\Objects\RequestBody;

use Tpay\Model\Fields\Transaction\Amount;
use Tpay\Model\Fields\Transaction\Description;
use Tpay\Model\Fields\Transaction\HiddenDescription;
use Tpay\Model\Fields\Transaction\Lang;
use Tpay\Model\Objects\Objects;
use Tpay\Model\Objects\Transactions\Callbacks;
use Tpay\Model\Objects\Transactions\Payer;
use Tpay\Model\Objects\Transactions\Verification;

class TransactionWithInstantRedirection extends Objects
{
    const OBJECT_FIELDS = [
        'amount' => Amount::class,
        'description' => Description::class,
        'hiddenDescription' => HiddenDescription::class,
        'lang' => Lang::class,
        'pay' => PayWithInstantRedirection::class,
        'verification' => Verification::class,
        'payer' => Payer::class,
        'callbacks' => Callbacks::class,
    ];

    /**
     * @var Amount
     */
    public $amount;

    /**
     * @var Description
     */
    public $description;

    /**
     * @var HiddenDescription
     */
    public $hiddenDescription;

    /**
     * @var Lang
     */
    public $lang;

    /**
     * @var PayWithInstantRedirection
     */
    public $pay;

    /**
     * @var Verification
     */
    public $verification;

    /**
     * @var Payer
     */
    public $payer;

    /**
     * @var Callbacks
     */
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
