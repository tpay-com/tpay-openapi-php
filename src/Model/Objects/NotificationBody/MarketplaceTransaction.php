<?php

namespace Tpay\OpenApi\Model\Objects\NotificationBody;

use Tpay\OpenApi\Model\Fields\Notification\Marketplace\CardToken;
use Tpay\OpenApi\Model\Fields\Notification\Marketplace\PayerEmail;
use Tpay\OpenApi\Model\Fields\Notification\Marketplace\TransactionAmount;
use Tpay\OpenApi\Model\Fields\Notification\Marketplace\TransactionDate;
use Tpay\OpenApi\Model\Fields\Notification\Marketplace\TransactionDescription;
use Tpay\OpenApi\Model\Fields\Notification\Marketplace\TransactionHiddenDescription;
use Tpay\OpenApi\Model\Fields\Notification\Marketplace\TransactionId;
use Tpay\OpenApi\Model\Fields\Notification\Marketplace\TransactionPaidAmount;
use Tpay\OpenApi\Model\Fields\Notification\Marketplace\TransactionStatus;
use Tpay\OpenApi\Model\Fields\Notification\Marketplace\TransactionTitle;
use Tpay\OpenApi\Model\Objects\Objects;

class MarketplaceTransaction extends Objects
{
    const OBJECT_FIELDS = [
        'transactionId' => TransactionId::class,
        'transactionTitle' => TransactionTitle::class,
        'transactionAmount' => TransactionAmount::class,
        'transactionPaidAmount' => TransactionPaidAmount::class,
        'transactionStatus' => TransactionStatus::class,
        'transactionHiddenDescription' => TransactionHiddenDescription::class,
        'payerEmail' => PayerEmail::class,
        'transactionDate' => TransactionDate::class,
        'transactionDescription' => TransactionDescription::class,
        'cardToken' => CardToken::class,
    ];

    /** @var TransactionId */
    public $transactionId;

    /** @var TransactionTitle */
    public $transactionTitle;

    /** @var TransactionAmount */
    public $transactionAmount;

    /** @var TransactionPaidAmount */
    public $transactionPaidAmount;

    /** @var TransactionStatus */
    public $transactionStatus;

    /** @var TransactionHiddenDescription */
    public $transactionHiddenDescription;

    /** @var PayerEmail */
    public $payerEmail;

    /** @var TransactionDate */
    public $transactionDate;

    /** @var TransactionDescription */
    public $transactionDescription;

    /** @var CardToken */
    public $cardToken;

    public function getRequiredFields()
    {
        return [
            $this->transactionId,
            $this->transactionTitle,
            $this->transactionAmount,
            $this->transactionPaidAmount,
            $this->transactionStatus,
            $this->transactionHiddenDescription,
            $this->payerEmail,
            $this->transactionDate,
            $this->transactionDescription,
        ];
    }
}