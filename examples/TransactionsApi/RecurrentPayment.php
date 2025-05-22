<?php

namespace Tpay\Example\TransactionsApi;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\FilesystemCache;
use PSX\Cache\SimpleCache;
use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\OpenApi\Utilities\TpayException;

final class RecurrentPayment extends ExamplesConfig
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
        //You can inject any of your PSR6 or PSR16 cache implementation
        $cache = new Cache(null, new SimpleCache(new FilesystemCache(__DIR__.'/cache/')));
        $TpayApi = new TpayApi($cache, self::MERCHANT_CLIENT_ID, self::MERCHANT_CLIENT_SECRET, true, 'read');
        $transaction = $TpayApi->transactions()->createTransaction($request);
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
