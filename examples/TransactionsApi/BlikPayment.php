<?php

namespace Tpay\Example\TransactionsApi;

use Doctrine\Common\Cache\FilesystemCache;
use PSX\Cache\SimpleCache;
use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Forms\PaymentForms;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\OpenApi\Utilities\TpayException;

final class BlikPayment extends ExamplesConfig
{
    public function __construct()
    {
        parent::__construct();
        if (isset($_POST['blik_code'])) {
            $this->processPayment($_POST['blik_code']);
        } else {
            $PaymentForms = new PaymentForms('en');
            echo $PaymentForms->getBlikCodeForm('BlikPayment.php');
        }
    }

    protected function processPayment($blikCode)
    {
        $cache = new Cache(null, new SimpleCache(new FilesystemCache(__DIR__.'/cache/')));
        $TpayApi = new TpayApi($cache, self::MERCHANT_CLIENT_ID, self::MERCHANT_CLIENT_SECRET, true, 'read');
        $transaction = $TpayApi->transactions()->createTransaction($this->getRequestBody());
        if (isset($transaction['transactionId'])) {
            $blikPaymentFields = [
                'groupId' => 150,
                'method' => 'transfer',
                'blikPaymentData' => [
                    'blikToken' => $blikCode,
                    'type' => 0,
                ],
            ];
            $result = $TpayApi->transactions()
                ->createPaymentByTransactionId($blikPaymentFields, $transaction['transactionId']);
            if (isset($result['result']) && 'success' === $result['result']) {
                // The BLIK code was valid, now the customer needs to confirm payment on his mobile app
                // Redirect client to thank you page and wait for asynchronous POST payment notification
                // Do not mark your order as paid here!
                echo 'BLIK code is valid';
            } else {
                // The BLIK code was incorrect, redirect to transaction panel to try again
                header('Location: '.$transaction['transactionPaymentUrl']);
            }
        } else {
            // Code error handling @see POST /transactions HTTP 400 response details
            throw new TpayException('Unable to create transaction. Response: '.json_encode($transaction));
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
                'groupId' => 150,
            ],
        ];
    }
}

new BlikPayment();
