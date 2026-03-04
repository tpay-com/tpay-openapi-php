<?php

namespace Tpay\OpenApi\Model\Objects\NotificationBody;

use Tpay\OpenApi\Model\Fields\Notification\Recurring\IterationCount;
use Tpay\OpenApi\Model\Fields\Notification\Recurring\IterationCountAttempt;
use Tpay\OpenApi\Model\Fields\Notification\Recurring\NextChargeDate;
use Tpay\OpenApi\Model\Fields\Notification\Recurring\Reason;
use Tpay\OpenApi\Model\Fields\Notification\Recurring\Status;
use Tpay\OpenApi\Model\Fields\Notification\Recurring\TransactionId;
use Tpay\OpenApi\Model\Fields\Recurring\HiddenDescription;
use Tpay\OpenApi\Model\Fields\Recurring\Id;
use Tpay\OpenApi\Model\Objects\Objects;

class Recurring extends Objects
{
    const OBJECT_FIELDS = [
        'recurringId' => Id::class,
        'transactionId' => TransactionId::class,
        'hiddenDescription' => HiddenDescription::class,
        'iterationCount' => IterationCount::class,
        'iterationAttemptCount' => IterationCountAttempt::class,
        'status' => Status::class,
        'nextChargeDate' => NextChargeDate::class,
        'reason' => Reason::class,
    ];

    /** @var Id */
    public $recurringId;

    /** @var TransactionId */
    public $transactionId;

    /** @var HiddenDescription */
    public $hiddenDescription;

    /** @var IterationCount */
    public $iterationCount;

    /** @var IterationCountAttempt */
    public $iterationAttemptCount;

    /** @var Status */
    public $status;

    /** @var NextChargeDate */
    public $nextChargeDate;

    /** @var Reason */
    public $reason;

    public function getRequiredFields()
    {
        return [
            $this->recurringId,
            $this->transactionId,
            $this->hiddenDescription,
            $this->iterationCount,
            $this->iterationAttemptCount,
            $this->status,
        ];
    }
}
