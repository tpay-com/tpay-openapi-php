<?php

namespace Tpay\OpenApi\Api\Recurring;

use Tpay\OpenApi\Api\ApiAction;
use Tpay\OpenApi\Model\Fields\Recurring\PaymentInstrument\PaymentType;
use Tpay\OpenApi\Model\Objects\RequestBody\Recurring;
use Tpay\OpenApi\Model\Objects\RequestBody\UpdatePaymentInstrument;
use UnexpectedValueException;

class RecurringApi extends ApiAction
{
    private const PAYMENT_INSTRUMENT_FIELD = 'paymentInstrument';
    private const PAYMENT_TYPE_FIELD = 'paymentType';

    /** @param array $queryFields */
    public function getRecurring($queryFields = [])
    {
        $requestUrl = $this->addQueryFields('/recurring', $queryFields);

        return $this->run(static::GET, $requestUrl);
    }

    /** @param string $recurringId */
    public function getRecurringById($recurringId)
    {
        return $this->run(static::GET, sprintf('/recurring/%s', $recurringId));
    }

    /**
     * @param string $recurringId
     * @param array  $queryFields
     */
    public function getTransactionsByRecurringId($recurringId, $queryFields = [])
    {
        $requestUrl = $this->addQueryFields(sprintf('/recurring/%s/transactions', $recurringId), $queryFields);

        return $this->run(static::GET, $requestUrl);
    }

    /** @param array $fields */
    public function createRecurring($fields)
    {
        $this->validateProductionPaymentType($fields);

        return $this->run(static::POST, '/recurring', $fields, new Recurring());
    }

    /** @param string $recurringId */
    public function cancelRecurring($recurringId)
    {
        return $this->run(static::POST, sprintf('/recurring/%s/cancel', $recurringId));
    }

    /** @param string $recurringId */
    public function retryRecurring($recurringId)
    {
        return $this->run(static::POST, sprintf('/recurring/%s/retry', $recurringId));
    }

    /** @param string $recurringId */
    public function updatePaymentInstrument($fields, $recurringId)
    {
        return $this->run(
            static::POST,
            sprintf('/recurring/%s/payment_instrument', $recurringId),
            $fields,
            new UpdatePaymentInstrument()
        );
    }

    /** @param array $fields */
    private function validateProductionPaymentType($fields)
    {
        if (
            !$this->isProductionMode()
            || !isset($fields[self::PAYMENT_INSTRUMENT_FIELD][self::PAYMENT_TYPE_FIELD])
            || PaymentType::TEST !== $fields[self::PAYMENT_INSTRUMENT_FIELD][self::PAYMENT_TYPE_FIELD]
        ) {
            return;
        }

        throw new UnexpectedValueException(
            sprintf('paymentType "%s" is not allowed in production mode', PaymentType::TEST)
        );
    }
}
