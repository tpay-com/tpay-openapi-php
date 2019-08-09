<?php
namespace tpaySDK\Examples\TransactionsApi;

use tpaySDK\Api\TpayApi;
use tpaySDK\Examples\ExamplesConfig;
use tpaySDK\Forms\PaymentForms;
use tpaySDK\Model\Fields\FieldTypes;
use tpaySDK\Utilities\TpayException;
use tpaySDK\Utilities\Util;

require_once '../ExamplesConfig.php';
require_once '../../Loader.php';

class CardGate extends ExamplesConfig
{
    public function init()
    {
        if (empty($_POST)) {
            $PaymentForms = new PaymentForms('en');
            //Show new payment form
            echo $PaymentForms->getOnSiteCardForm(static::MERCHANT_RSA_KEY, 'CardGate.php', true, false);
        } else {
            $transaction = $this->getNewCardTransaction();
            if (!isset($transaction['transactionId'])) {
                //Code error handling @see POST /transactions HTTP 400 response details
                throw new TpayException('Unable to create transaction. Response: '.json_encode($transaction));
            } else {
                //Try to sale with provided card data
                $response = $this->makeCardPayment($transaction);
                if (isset($response['result']) && $response['result'] === 'success' && !isset($response['continueUrl'])) {
                    //Successful payment by card not protected by 3DS
                    $this->setOrderAsComplete($response);
                } elseif (isset($response['continueUrl'])) {
                    //Successfully generated 3DS link for payment authorization
                    header("Location: ".$response['continueUrl']);
                } else {
                    //Invalid credit card data
                    header("Location: ".$transaction['transactionPaymentUrl']);
                }
            }
        }
    }

    private function makeCardPayment($transaction)
    {
        $cardData = Util::cast($_POST['carddata'], FieldTypes::STRING);
        $saveCard = Util::cast($_POST['card_save'], FieldTypes::STRING);
        $request = [
            'groupId' => 'gr_k9NmLeGvN6GbEP4j',
            'cardPaymentData' => [
                'card' => $cardData,
                'save' => $saveCard === 'on',
            ],
            'method' => 'sale',
        ];
        $TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');

        return $TpayApi->Transactions->createPaymentByTransactionId($request, $transaction['transactionId']);
    }

    private function setOrderAsComplete($response)
    {
        var_dump($response);
    }

    private function getNewCardTransaction()
    {
        //If you set the fourth getOnSiteCardForm() parameter true, you can get client name and email here.
        //Otherwise, you must get those values from your DB.
//        $clientName = Util::cast($_POST['client_name'], FieldTypes::STRING);
//        $clientEmail = Util::cast($_POST['client_email'], FieldTypes::STRING);
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
                'groupId' => 'gr_k9NmLeGvN6GbEP4j',
            ],
        ];
        $TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');

        return $TpayApi->Transactions->createTransaction($request);
    }

}

(new CardGate)->init();
