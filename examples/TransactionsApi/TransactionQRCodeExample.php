<?php

namespace Tpay\Example\TransactionsApi;

use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;

final class TransactionQRCodeExample extends ExamplesConfig
{
    private $TpayApi;

    public function __construct()
    {
        parent::__construct();
        $this->TpayApi = new TpayApi(self::MERCHANT_CLIENT_ID, self::MERCHANT_CLIENT_SECRET, true, 'read');
    }

    public function runAllExamples()
    {
        $transaction = $this->createBasicTransaction(150);
        $this->getTransactionQR($transaction['transactionId']);
        $this->getTransactionQR($transaction['transactionId'], 'S', __DIR__.'/../TPAY_LOGO_RGB.png');
        $this->getTransactionQR($transaction['transactionId'], 'XL', __DIR__.'/../TPAY_LOGO_RGB.png', 'image/jpeg');
        $this->getTransactionQR($transaction['transactionId'], 'M', null, 'image/svg+xml');
    }

    // Create transaction with a specified bank group id
    public function createBasicTransaction($bankGroupId)
    {
        $transactionParameters = $this->getTransactionParameters();
        $transactionParameters['pay'] = ['groupId' => $bankGroupId];
        $newTransaction = $this->TpayApi->transactions()->createTransaction($transactionParameters);
        echo '<hr />';
        echo '<pre>';
        echo json_encode($newTransaction, JSON_PRETTY_PRINT);
        echo '</pre>';

        return $newTransaction;
    }

    protected function getTransactionParameters()
    {
        return [
            'amount' => 0.10,
            'description' => 'test transaction',
            'hiddenDescription' => 'order_213',
            'payer' => [
                'email' => 'john.doe@example.com',
                'name' => 'John Doe',
                'phone' => '123456789',
                'address' => 'Long Street 123/2',
                'code' => '11-123',
                'city' => 'New York',
                'country' => 'US',
                'taxId' => 'PL3774716081',
            ],
            'lang' => 'en',
            'callbacks' => [
                'notification' => [
                    'url' => 'https://example.com/notification',
                    'email' => 'merchant@example.com',
                ],
                'payerUrls' => [
                    'success' => 'https://example.com/success',
                    'error' => 'https://example.com/error',
                ],
            ],
        ];
    }

    protected function getTransactionQR($transactionUid, $size = 'M', $logoPath = null, $desiredType = 'image/png')
    {
        $image = $this->TpayApi->transactions()->getTransactionQR($transactionUid, $size, $logoPath, $desiredType);
        echo '<hr />';
        echo '<image src="data:'.$desiredType.';base64, '.base64_encode($image).'" />';
    }
}

(new TransactionQRCodeExample())->runAllExamples();
