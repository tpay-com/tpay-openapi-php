<?php
namespace tpaySDK\Examples\TransactionsApi;

use tpaySDK\Api\TpayApi;
use tpaySDK\Examples\ExamplesConfig;
use tpaySDK\Utilities\TpayException;

require_once '../ExamplesConfig.php';
require_once '../../Loader.php';

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
                'groupId' => 'gr_k9NmLeGvN6GbEP4j',
                'cardPaymentData' => [
                    'cardToken' => $clientToken,
                ],
            ],
        ];
        $TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');
        $transaction = $TpayApi->Transactions->createTransaction($request);
        if (
            isset($transaction['result'], $transaction['status'])
            && $transaction['result'] === 'success'
            && $transaction['status'] === 'correct'
        ) {
            $this->setOrderAsConfirmed();
        } else {
            //Code your action when the recurrent payment fails
            throw new TpayException('Unable to process payment. Response: '.json_encode($transaction));
        }
    }

    private function setOrderAsConfirmed()
    {
        //Code updating order status as paid at your DB
        //Save transaction Id for later use
    }

}
(new RecurrentPayment)
    ->processPayment(
        'payment for order xyz',
        '5c87eb70c0e5060fb17da028c16011a840db2b83',
        1.00,
        'John Doe',
        'customer@example.com',
        'order_123456',
        'pl'
    );
