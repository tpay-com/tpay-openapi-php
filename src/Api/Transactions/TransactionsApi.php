<?php

namespace Tpay\Api\Transactions;

use Tpay\Api\ApiAction;
use Tpay\Model\Objects\RequestBody\Pay;
use Tpay\Model\Objects\RequestBody\Refund;
use Tpay\Model\Objects\RequestBody\Transaction;
use Tpay\Model\Objects\RequestBody\TransactionWithInstantRedirection;

class TransactionsApi extends ApiAction
{
    public function getTransactions($queryFields = [])
    {
        $requestUrl = $this->addQueryFields('/transactions', $queryFields);

        return $this->run(static::GET, $requestUrl);
    }

    public function getTransactionById($transactionId)
    {
        return $this->run(static::GET, sprintf('/transactions/%s', $transactionId));
    }

    public function getRefundsByTransactionId($transactionId, $queryFields = [])
    {
        $requestUrl = $this->addQueryFields(sprintf('/transactions/%s/refunds', $transactionId), $queryFields);

        return $this->run(static::GET, $requestUrl);
    }

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

    public function createTransaction($fields)
    {
        return $this->run(static::POST, '/transactions', $fields, new Transaction());
    }

    public function createTransactionWithInstantRedirection($fields)
    {
        return $this->run(static::POST, '/transactions', $fields, new TransactionWithInstantRedirection());
    }

    public function createPaymentByTransactionId($fields, $transactionId)
    {
        return $this->run(static::POST, sprintf('/transactions/%s/pay', $transactionId), $fields, new Pay());
    }

    public function createRefundByTransactionId($fields, $transactionId)
    {
        return $this->run(static::POST, sprintf('/transactions/%s/refunds', $transactionId), $fields, new Refund());
    }
}
