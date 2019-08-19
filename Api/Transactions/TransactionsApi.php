<?php
namespace tpaySDK\Api\Transactions;

use tpaySDK\Api\ApiAction;
use tpaySDK\Model\Objects\RequestBody\Pay;
use tpaySDK\Model\Objects\RequestBody\Refund;
use tpaySDK\Model\Objects\RequestBody\Transaction;

class TransactionsApi extends ApiAction
{
    public function getTransactions()
    {
        return $this->run(static::GET, '/transactions');
    }

    public function getTransactionById($transactionId)
    {
        return $this->run(static::GET, sprintf('/transactions/%s', $transactionId));
    }

    //Not yet implemented on server side
    public function getRefundsByTransactionId($transactionId)
    {
        return $this->run(static::GET, sprintf('/transactions/%s/refunds', $transactionId));
    }

    public function getBankGroups($onlineOnly = false)
    {
        $requestUrl = '/transactions/bank-groups';
        if ($onlineOnly === true) {
            $requestUrl = sprintf('%s?onlyOnline=true', $requestUrl);
        }

        return $this->run(static::GET, $requestUrl);
    }

    public function createTransaction($fields)
    {
        return $this->run(static::POST, '/transactions', $fields, new Transaction);
    }

    public function createPaymentByTransactionId($fields, $transactionId)
    {
        return $this->run(static::POST, sprintf('/transactions/%s/pay', $transactionId), $fields, new Pay);
    }

    //Not yet implemented on server side
    public function createRefundByTransactionId($fields, $transactionId)
    {
        return $this->run(static::POST, sprintf('/transactions/%s/refunds', $transactionId), $fields, new Refund);
    }

}
