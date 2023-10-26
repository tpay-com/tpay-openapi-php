<?php

namespace Tpay\OpenApi\Api\Transactions;

use Tpay\OpenApi\Api\ApiAction;
use Tpay\OpenApi\Model\Objects\RequestBody\Pay;
use Tpay\OpenApi\Model\Objects\RequestBody\Refund;
use Tpay\OpenApi\Model\Objects\RequestBody\Transaction;
use Tpay\OpenApi\Model\Objects\RequestBody\TransactionWithInstantRedirection;

class TransactionsApi extends ApiAction
{
    /** @param array $queryFields */
    public function getTransactions($queryFields = [])
    {
        $requestUrl = $this->addQueryFields('/transactions', $queryFields);

        return $this->run(static::GET, $requestUrl);
    }

    /** @param string $transactionId */
    public function getTransactionById($transactionId)
    {
        return $this->run(static::GET, sprintf('/transactions/%s', $transactionId));
    }

    /**
     * @param string $transactionId
     * @param array  $queryFields
     */
    public function getRefundsByTransactionId($transactionId, $queryFields = [])
    {
        $requestUrl = $this->addQueryFields(sprintf('/transactions/%s/refunds', $transactionId), $queryFields);

        return $this->run(static::GET, $requestUrl);
    }

    /** @param bool $onlineOnly */
    public function getBankGroups($onlineOnly = false)
    {
        $requestUrl = '/transactions/bank-groups';
        if (true === $onlineOnly) {
            $requestUrl = $this->addQueryFields($requestUrl, ['onlyOnline' => json_encode($onlineOnly)]);
        }

        return $this->run(static::GET, $requestUrl);
    }

    public function getChannels()
    {
        return $this->run(static::GET, '/transactions/channels');
    }

    /** @param array $fields */
    public function createTransaction($fields)
    {
        return $this->run(static::POST, '/transactions', $fields, new Transaction());
    }

    /** @param array $fields */
    public function createTransactionWithInstantRedirection($fields)
    {
        return $this->run(static::POST, '/transactions', $fields, new TransactionWithInstantRedirection());
    }

    /**
     * @param array  $fields
     * @param string $transactionId
     */
    public function createPaymentByTransactionId($fields, $transactionId)
    {
        return $this->run(static::POST, sprintf('/transactions/%s/pay', $transactionId), $fields, new Pay());
    }

    /**
     * @param array  $fields
     * @param string $transactionId
     */
    public function createRefundByTransactionId($fields, $transactionId)
    {
        return $this->run(static::POST, sprintf('/transactions/%s/refunds', $transactionId), $fields, new Refund());
    }
}
