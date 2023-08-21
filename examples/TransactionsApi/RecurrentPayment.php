<?php

namespace TpayExample\TransactionsApi;

use Tpay\Api\TpayApi;
use Tpay\Utilities\TpayException;
use TpayExample\ExamplesConfig;

require_once '../ExamplesConfig.php';
require_once '../../src/Loader.php';

class RecurrentPayment extends ExamplesConfig
{
    public function processPayment(
        $saleDescription,
        $clientToken,
        $amount,
        $clientName,
        $clientEmail,
        $orderId = null,
        $language = 'pl'
    ) {
        $request = [
            'amount' => $amount,
            'description' => $saleDescription,
            'hiddenDescription' => $orderId,
            'lang' => $language,
            'payer' => [
                'email' => $clientEmail,
                'name' => $clientName,
            ],
            'pay' => [
                'groupId' => 103,
                'cardPaymentData' => [
                    'token' => $clientToken,
                ],
            ],
        ];
        $TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');
        $transaction = $TpayApi->Transactions->createTransaction($request);
        if (
            isset($transaction['result'], $transaction['status'])
            && 'success' === $transaction['result']
            && 'correct' === $transaction['status']
        ) {
            $this->setOrderAsConfirmed();
        } else {
            // Code your action when the recurrent payment fails
            throw new TpayException('Unable to process payment. Response: '.json_encode($transaction));
        }
    }

    private function setOrderAsConfirmed()
    {
        // Code updating order status as paid at your DB
        // Save transaction Id for later use
    }
}
(new RecurrentPayment())
    ->processPayment(
        'payment for order xyz',
        '5c87eb70c0e5060fb17da028c16011a840db2b83',
        1.00,
        'John Doe',
        'customer@example.com',
        'order_123456',
        'pl'
    );
