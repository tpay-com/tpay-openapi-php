<?php

namespace Tpay\OpenApi\Model\Objects\NotificationBody;

use Tpay\OpenApi\Model\Fields\Notification\CardToken;
use Tpay\OpenApi\Model\Fields\Notification\Crc;
use Tpay\OpenApi\Model\Fields\Notification\Description;
use Tpay\OpenApi\Model\Fields\Notification\Email;
use Tpay\OpenApi\Model\Fields\Notification\Error;
use Tpay\OpenApi\Model\Fields\Notification\Masterpass;
use Tpay\OpenApi\Model\Fields\Notification\Md5sum;
use Tpay\OpenApi\Model\Fields\Notification\MerchantId;
use Tpay\OpenApi\Model\Fields\Notification\Paid;
use Tpay\OpenApi\Model\Fields\Notification\TestMode;
use Tpay\OpenApi\Model\Fields\Notification\TransactionAmount;
use Tpay\OpenApi\Model\Fields\Notification\TransactionChannel;
use Tpay\OpenApi\Model\Fields\Notification\TransactionDate;
use Tpay\OpenApi\Model\Fields\Notification\TransactionId;
use Tpay\OpenApi\Model\Fields\Notification\TransactionStatus;
use Tpay\OpenApi\Model\Fields\Notification\Wallet;
use Tpay\OpenApi\Model\Objects\Objects;

class BasicPayment extends Objects
{
    const OBJECT_FIELDS = [
        'id' => MerchantId::class,
        'tr_id' => TransactionId::class,
        'tr_date' => TransactionDate::class,
        'tr_crc' => Crc::class,
        'tr_amount' => TransactionAmount::class,
        'tr_paid' => Paid::class,
        'tr_desc' => Description::class,
        'tr_status' => TransactionStatus::class,
        'tr_error' => Error::class,
        'tr_email' => Email::class,
        'md5sum' => Md5sum::class,
        'test_mode' => TestMode::class,
        'wallet' => Wallet::class,
        'masterpass' => Masterpass::class,
        'tr_channel' => TransactionChannel::class,
        'card_token' => CardToken::class,
    ];

    /**
     * @var MerchantId
     */
    public $id;

    /**
     * @var TransactionId
     */
    public $tr_id;

    /**
     * @var TransactionDate
     */
    public $tr_date;

    /**
     * @var Crc
     */
    public $tr_crc;

    /**
     * @var TransactionAmount
     */
    public $tr_amount;

    /**
     * @var Paid
     */
    public $tr_paid;

    /**
     * @var Description
     */
    public $tr_desc;

    /**
     * @var TransactionStatus
     */
    public $tr_status;

    /**
     * @var Error
     */
    public $tr_error;

    /**
     * @var Email
     */
    public $tr_email;

    /**
     * @var Md5sum
     */
    public $md5sum;

    /**
     * @var TestMode
     */
    public $test_mode;

    /**
     * @var Wallet
     */
    public $wallet;

    /**
     * @var Masterpass
     */
    public $masterpass;

    /**
     * @var TransactionChannel
     */
    public $tr_channel;

    /**
     * @var CardToken
     */
    public $card_token;

    public function getRequiredFields()
    {
        return [
            $this->id,
            $this->tr_id,
            $this->tr_date,
            $this->tr_crc,
            $this->tr_amount,
            $this->tr_paid,
            $this->tr_desc,
            $this->tr_status,
            $this->tr_error,
            $this->tr_email,
            $this->md5sum,
        ];
    }

    /**
     * Returns associative array containing all notification fields
     *
     * @return array
     */
    public function getNotificationAssociative()
    {
        $notification = [];
        foreach (static::OBJECT_FIELDS as $fieldName => $fieldClass) {
            if (isset($this->$fieldName) && !is_null($this->$fieldName->getValue())) {
                $notification[$fieldName] = $this->$fieldName->getValue();
            }
        }

        return $notification;
    }
}
