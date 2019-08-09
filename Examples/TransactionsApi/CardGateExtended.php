<?php
namespace tpaySDK\Examples\TransactionsApi;

use tpaySDK\Api\TpayApi;
use tpaySDK\Examples\ExamplesConfig;
use tpaySDK\Forms\PaymentForms;
use tpaySDK\Model\Fields\FieldTypes;
use tpaySDK\Utilities\Logger;
use tpaySDK\Utilities\TpayException;
use tpaySDK\Utilities\Util;

require_once '../ExamplesConfig.php';
require_once '../../Loader.php';

class CardGateExtended extends ExamplesConfig
{
    const SUPPORTED_CARD_VENDORS = [
        'visa',
        'mastercard',
        'maestro',
    ];

    public function init()
    {
        if (isset($_POST['carddata'])) {
            if (isset($_POST['card_vendor']) && in_array($_POST['card_vendor'], static::SUPPORTED_CARD_VENDORS)) {
                $this->saveUserCardVendor($_POST['card_vendor']);
            }
            //Try to sale with provided card data
            $response = $this->makeCardPayment();
            //Successful payment by card not protected by 3DS
            if (isset($response['result']) && $response['result'] === 'success' && !isset($response['continueUrl'])) {
                $this->setOrderAsComplete($response);
                //Successfully generated 3DS link for payment authorization
            } elseif (isset($response['continueUrl'])) {
                header("Location: ".$response['continueUrl']);
            } else {
                //Invalid credit card data
                $transaction = $this->getNewCardTransaction();
                header("Location: ".$transaction['transactionPaymentUrl']);
            }
        } elseif (isset($_POST['savedId'])) {
            //Payment by saved card
            $this->processSavedCardPayment($_POST['savedId']);
        } else {
            $userCards = $this->getUserSavedCards($this->getCurrentUserId());
            //Show new payment form
            echo (new PaymentForms('en'))
                ->getOnSiteCardForm(static::MERCHANT_RSA_KEY, 'CardGateExtended.php', true, false, $userCards);
        }
    }

    private function saveUserCardVendor($cardVendor)
    {
        //Code saving the user card vendor name for later use
    }

    private function getNewCardTransaction()
    {
        //If you set the fourth getOnSiteCardForm() parameter true, you can get client name and email here. Otherwise, you must get those values from your DB.
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
        $result = $TpayApi->Transactions->createTransaction($request);
        if (!isset($result['transactionId'])) {
            throw new TpayException('Unable to create transaction. Response: '.json_encode($result));
        }

        return $result;
    }

    private function makeCardPayment()
    {
        $cardData = Util::cast($_POST['carddata'], FieldTypes::STRING);
        $saveCard = Util::cast($_POST['card_save'], FieldTypes::STRING);
        $transaction = $this->getNewCardTransaction();
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

    private function processSavedCardPayment($savedCardId)
    {
        $transaction = $this->getNewCardTransaction();
        $exampleCurrentUserId = $this->getCurrentUserId();
        if (!is_numeric($savedCardId)) {
            Logger::log('Invalid saved cardId', 'CardId: '.$savedCardId);

            return header("Location: ".$transaction['transactionPaymentUrl']);
        }
        $requestedCardId = (int)$savedCardId;
        $currentUserCards = $this->getUserSavedCards($exampleCurrentUserId);
        $isValid = false;
        $cardToken = '';
        foreach ($currentUserCards as $card) {
            if ($card['cardId'] === $requestedCardId) {
                $isValid = true;
                $cardToken = $card['cli_auth'];
            }
        }
        if ($isValid === false) {
            Logger::log(
                'Unauthorized payment try',
                sprintf('User %s has tried to pay by not owned cardId: %s', $exampleCurrentUserId, $requestedCardId)
            );

            //Reject current payment try and redirect user to tpay payment panel new card form
            return header("Location: ".$transaction['transactionPaymentUrl']);
        } else {
            return $this->payBySavedCard($cardToken, $transaction);
        }
    }

    private function payBySavedCard($cardToken, $transaction)
    {
        $request = [
            'groupId' => 'gr_k9NmLeGvN6GbEP4j',
            'cardPaymentData' => [
                'cardToken' => $cardToken,
            ],
            'method' => 'sale',
        ];
        $TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');
        $result = $TpayApi->Transactions->createPaymentByTransactionId($request, $transaction['transactionId']);
        if (isset($result['result']) && $result['result'] === 'success') {
            return $this->setOrderAsComplete($result);
        } else {
            return header("Location: ".$transaction['transactionPaymentUrl']);
        }
    }

    private function setOrderAsComplete($params)
    {
        //Code setting the order status and other details in your system
        var_dump($params);
    }

    /**
     * Returns stored cards by userId as array. Each row contains card details
     * @param int $userId
     * @return array
     */
    private function getUserSavedCards($userId = 0)
    {
        //Code getting current logged user cards from your DB. This is only an example of DB.
        $exampleDbUsersIdsWithCards = [
            0 => [],
            2 => [
                [
                    'cardId' => 1,
                    'vendor' => 'visa',
                    'shortCode' => '****1111',
                    'cli_auth' => 't5ca63654a3c44a8fac1dea7f1227b9f5d8dc4af',
                ],
                [
                    'cardId' => 2,
                    'vendor' => 'mastercard',
                    'shortCode' => '****4444',
                    'cli_auth' => 't5ca636697eebe24b5c2cf02f5d7723f1297f825',
                ],
            ],
            3 => [
                [
                    'cardId' => 3,
                    'vendor' => 'visa',
                    'shortCode' => '****3321',
                    'cli_auth' => 't5ca6367039f480aa9df557798b47748681f1f05',
                ],
            ],
        ];

        if (isset($exampleDbUsersIdsWithCards[$userId])) {
            return $exampleDbUsersIdsWithCards[$userId];
        }

        return [];
    }

    private function getCurrentUserId()
    {
        //Code getting the user Id from your system. This is only an example.
        return 2;
    }

}

(new CardGateExtended)->init();
