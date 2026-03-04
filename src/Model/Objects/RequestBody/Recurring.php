<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\Recurring\CallbackUrl;
use Tpay\OpenApi\Model\Fields\Recurring\Description;
use Tpay\OpenApi\Model\Fields\Recurring\HiddenDescription;
use Tpay\OpenApi\Model\Fields\Recurring\Id;
use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Model\Objects\Recurring\Payer;
use Tpay\OpenApi\Model\Objects\Recurring\PaymentInstrument;
use Tpay\OpenApi\Model\Objects\Recurring\Schedule;

class Recurring extends Objects
{
    const OBJECT_FIELDS = [
        'id' => Id::class,
        'description' => Description::class,
        'hiddenDescription' => HiddenDescription::class,
        'payer' => Payer::class,
        'schedule' => Schedule::class,
        'paymentInstrument' => PaymentInstrument::class,
        'callbackUrl' => CallbackUrl::class,
    ];

    /** @var Id */
    public $id;

    /** @var Description */
    public $description;

    /** @var HiddenDescription */
    public $hiddenDescription;

    /** @var Payer */
    public $payer;

    /** @var Schedule */
    public $schedule;

    /** @var PaymentInstrument */
    public $paymentInstrument;

    /** @var CallbackUrl */
    public $callbackUrl;

    public function getRequiredFields()
    {
        return [
            $this->id,
            $this->description,
            $this->payer,
            $this->schedule,
            $this->paymentInstrument,
            $this->callbackUrl,
        ];
    }
}
