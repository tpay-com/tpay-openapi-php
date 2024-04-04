<?php

namespace Tpay\Example\TransactionsApi;

use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Forms\PaymentForms;
use Tpay\OpenApi\Model\Fields\FieldTypes;
use Tpay\OpenApi\Utilities\TpayException;
use Tpay\OpenApi\Utilities\Util;

final class CardGate extends ExamplesConfig
{
    private $TpayApi;

    public function __construct()
    {
        parent::__construct();
        $this->TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');
    }

    public function init()
    {
        if (empty($_POST)) {
            $PaymentForms = new PaymentForms('en');
            // Show new payment form
            echo $PaymentForms->getOnSiteCardForm(static::MERCHANT_RSA_KEY, 'CardGate.php', true, false);
        } else {
            $this->processNewCardPayment();
        }
    }

    private function processNewCardPayment()
    {
        if (isset($_POST['card_vendor'], $_POST['card_short_code'])) {
            $this->saveUserCardDetails($_POST['card_vendor'], $_POST['card_short_code']);
        }
        $transaction = $this->getNewCardTransaction();
        if (!isset($transaction['transactionId'])) {
            // Code error handling @see POST /transactions HTTP 400 response details
            throw new TpayException('Unable to create transaction. Response: '.json_encode($transaction));
        }
        // Try to sale with provided card data
        $response = $this->makeCardPayment($transaction);
        if (!isset($response['result']) || 'failure' === $response['result']) {
            header('Location: '.$transaction['transactionPaymentUrl']);
        }
        if (isset($response['status']) && 'correct' === $response['status']) {
            // Successful payment by card not protected by 3DS
            $this->setOrderAsComplete($response);
        } elseif (isset($response['transactionPaymentUrl'])) {
            // Successfully generated 3DS link for payment authorization
            header('Location: '.$response['transactionPaymentUrl']);
        } else {
            // Invalid credit card data
            header('Location: '.$transaction['transactionPaymentUrl']);
        }
    }

    private function makeCardPayment($transaction)
    {
        if (isset($_POST['card_save'])) {
            $saveCard = Util::cast($_POST['card_save'], FieldTypes::STRING);
        } else {
            $saveCard = false;
        }
        $cardData = Util::cast($_POST['carddata'], FieldTypes::STRING);
        $request = [
            'groupId' => 103,
            'cardPaymentData' => [
                'card' => $cardData,
                'save' => 'on' === $saveCard,
            ],
            'method' => 'pay_by_link',
        ];

        return $this->TpayApi->transactions()->createPaymentByTransactionId($request, $transaction['transactionId']);
    }

    private function setOrderAsComplete($response)
    {
        var_dump($response);
    }

    private function getNewCardTransaction()
    {
        // If you set the fourth getOnSiteCardForm() parameter true, you can get client name and email here.
        // Otherwise, you must get those values from your DB.
        $clientEmail = 'customer@example.com';
        $clientName = 'John Doe';
        $request = [
            'amount' => 0.10,
            'description' => 'test transaction',
            'hiddenDescription' => 'order_213',
            'payer' => [
                'email' => $clientEmail,
                'name' => $clientName,
            ],
            'lang' => 'pl',
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
                'groupId' => 103,
            ],
        ];

        return $this->TpayApi->transactions()->createTransaction($request);
    }

    private function saveUserCardDetails($cardVendor, $cardShortCode)
    {
        // Code saving the user card vendor name and short code for later use
    }
}

(new CardGate())->init();
