<?php

namespace Tpay\OpenApi\Api\Transactions;

use Tpay\OpenApi\Api\ApiAction;
use Tpay\OpenApi\Model\Objects\RequestBody\InitApplePay;
use Tpay\OpenApi\Model\Objects\RequestBody\Pay;
use Tpay\OpenApi\Model\Objects\RequestBody\PayWithInstantRedirection;
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

    public function getTransactionQR($transactionId, $size = 'M', $logoPath = null, $desiredType = 'image/png')
    {
        $image = null;
        $imageType = null;
        if (null !== $logoPath && file_exists($logoPath) && is_readable($logoPath)) {
            $image = base64_encode(file_get_contents($logoPath));
            $imageType = mime_content_type($logoPath);
        }

        $fields = [
            'size' => $size,
            'logo' => $image,
            'logoType' => $imageType,
            'outputType' => $desiredType,
        ];

        return $this
            ->sendRequest(
                sprintf('/transactions/%s/qr', $transactionId),
                static::POST,
                $fields
            )
            ->getRequestResult(false);
    }

    /**
     * @param string $transactionId
     * @param array $queryFields
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
     * @param array $fields
     * @param string $transactionId
     */
    public function createPaymentByTransactionId($fields, $transactionId)
    {
        return $this->run(static::POST, sprintf('/transactions/%s/pay', $transactionId), $fields, new Pay());
    }

    /**
     * @param array $fields
     * @param string $transactionId
     */
    public function createInstantPaymentByTransactionId($fields, $transactionId)
    {
        return $this->run(
            static::POST,
            sprintf('/transactions/%s/pay', $transactionId),
            $fields,
            new PayWithInstantRedirection()
        );
    }

    /**
     * @param array $fields
     * @param string $transactionId
     */
    public function createRefundByTransactionId($fields, $transactionId)
    {
        return $this->run(static::POST, sprintf('/transactions/%s/refunds', $transactionId), $fields, new Refund());
    }

    /** @param string $transactionId */
    public function cancelTransaction($transactionId)
    {
        return $this->run(static::POST, sprintf('/transactions/%s/pay', $transactionId));
    }

    /** @param array $fields */
    public function initApplePay($fields)
    {
        return $this->run(static::POST, '/wallet/applepay/init', $fields, new InitApplePay());
    }
}
