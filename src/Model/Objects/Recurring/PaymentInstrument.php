<?php

namespace Tpay\OpenApi\Model\Objects\Recurring;

use UnexpectedValueException;
use Tpay\OpenApi\Model\Fields\Recurring\PaymentInstrument\PaymentType;
use Tpay\OpenApi\Model\Fields\Recurring\PaymentInstrument\Value;
use Tpay\OpenApi\Model\Objects\Objects;

class PaymentInstrument extends Objects
{
    const OBJECT_FIELDS = [
        'paymentType' => PaymentType::class,
        'value' => Value::class,
        'blik' => BlikPaymentDetails::class,
    ];

    /** @var PaymentType */
    public $paymentType;

    /** @var Value */
    public $value;

    /** @var BlikPaymentDetails */
    public $blik;

    public function getRequiredFields()
    {
        $requiredFields = [
            $this->paymentType,
            $this->value,
        ];

        if (PaymentType::BLIK_PAYID === $this->paymentType->getValue() && $this->wasFieldProvided('blik')) {
            $requiredFields[] = $this->blik;
        }

        return $requiredFields;
    }

    public function validate()
    {
        if (PaymentType::CARD_TOKEN === $this->paymentType->getValue() && $this->wasFieldProvided('blik')) {
            throw new UnexpectedValueException(
                sprintf('Field "blik" must be null when paymentType is "%s"', PaymentType::CARD_TOKEN)
            );
        }

        if (PaymentType::BLIK_PAYID === $this->paymentType->getValue() && !$this->wasFieldProvided('blik')) {
            throw new UnexpectedValueException(
                sprintf('Field "blik" is required when paymentType is "%s"', PaymentType::BLIK_PAYID)
            );
        }

        return true;
    }
}
