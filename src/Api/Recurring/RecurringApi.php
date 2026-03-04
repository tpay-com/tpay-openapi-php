<?php

namespace Tpay\OpenApi\Api\Recurring;

use Tpay\OpenApi\Api\ApiAction;
use Tpay\OpenApi\Model\Objects\RequestBody\Recurring;

class RecurringApi extends ApiAction
{
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
        return $this->run(static::POST, '/recurring', $fields, new Recurring());
    }

    /** @param string $recurringId */
    public function cancelTransaction($recurringId)
    {
        return $this->run(static::POST, sprintf('/recurring/%s/cancel', $recurringId));
    }

    /** @param string $recurringId */
    public function updatePaymentInstrument($fields, $recurringId)
    {
        return $this->run(
            static::POST,
            sprintf('/recurring/%s/payment_instrument', $recurringId),
            $fields
        );
    }
}
