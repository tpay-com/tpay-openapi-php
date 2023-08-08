<?php

namespace tpaySDK\Examples\TransactionsApi;

use tpaySDK\Api\TpayApi;
use tpaySDK\Examples\ExamplesConfig;
use tpaySDK\Utilities\TpayException;

require_once '../ExamplesConfig.php';
require_once '../../Loader.php';

class RedirectPayment extends ExamplesConfig
{
    public function processTransaction()
    {
        if (!isset($_POST['groupId'])) {
            throw new TpayException('No payment group Id, unable to create transaction');
        }
        $TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');
        $result = $TpayApi->Transactions->createTransaction($this->getRequestBody());
        if (isset($result['transactionPaymentUrl'])) {
            header('Location: '.$result['transactionPaymentUrl']);
        } else {
            //Code error handling @see POST /transactions HTTP 400 response details
            throw new TpayException('Unable to create transaction. Response: '.json_encode($result));
        }
    }

    protected function getRequestBody()
    {
        return [
            'amount' => 0.10,
            'description' => 'test transaction',
            'hiddenDescription' => 'order_213',
            'payer' => [
                'email' => 'customer@example.com',
                'name' => 'John Doe',
            ],
            'callbacks' => [
                'notification' => [
                    'url' => 'https://example.com/notification',
                ],
                'payerUrls' => [
                    'success' => 'https://example.com/success',
                    'error' => 'https://example.com/error',
                ],
            ],
            'pay' => [
                'groupId' => (int)$_POST['groupId'],
            ],
        ];
    }
}

(new RedirectPayment())->processTransaction();
