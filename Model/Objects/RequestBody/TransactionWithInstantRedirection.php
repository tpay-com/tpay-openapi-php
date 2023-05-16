<?php
namespace tpaySDK\Model\Objects\RequestBody;

use tpaySDK\Model\Fields\Transaction\Amount;
use tpaySDK\Model\Fields\Transaction\Description;
use tpaySDK\Model\Fields\Transaction\HiddenDescription;
use tpaySDK\Model\Fields\Transaction\Lang;
use tpaySDK\Model\Objects\Objects;
use tpaySDK\Model\Objects\Transactions\Callbacks;
use tpaySDK\Model\Objects\Transactions\Payer;
use tpaySDK\Model\Objects\Transactions\Verification;

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

    public function getRequiredFields()
    {
        return [
            $this->amount,
            $this->description,
            $this->payer,
        ];
    }

}
