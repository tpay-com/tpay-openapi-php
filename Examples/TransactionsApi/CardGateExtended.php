<?php

namespace tpaySDK\Examples\TransactionsApi;

use Tpay\Api\TpayApi;
use Tpay\Forms\PaymentForms;
use Tpay\Model\Fields\FieldTypes;
use Tpay\Utilities\Logger;
use Tpay\Utilities\TpayException;
use Tpay\Utilities\Util;
use tpaySDK\Examples\ExamplesConfig;

require_once '../ExamplesConfig.php';
require_once '../../src/Loader.php';

class CardGateExtended extends ExamplesConfig
{
    private $TpayApi;

    public function __construct()
    {
        parent::__construct();
        $this->TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');
    }

    public function init()
    {
        if (isset($_POST['carddata'])) {
            $this->processNewCardPayment();
        } elseif (isset($_POST['savedId'])) {
            // Payment by saved card
            $this->processSavedCardPayment($_POST['savedId']);
        } else {
            $userCards = $this->getUserSavedCards($this->getCurrentUserId());
            // Show new payment form
            echo (new PaymentForms('en'))
                ->getOnSiteCardForm(static::MERCHANT_RSA_KEY, 'CardGateExtended.php', true, false, $userCards);
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

    private function saveUserCardDetails($cardVendor, $cardShortCode)
    {
        // Code saving the user card vendor name and short code for later use
    }

    private function getNewCardTransaction()
    {
        // If you set the fourth getOnSiteCardForm() parameter true, you can get client name and email here. Otherwise, you must get those values from your DB.
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
        $result = $this->TpayApi->Transactions->createTransaction($request);
        if (!isset($result['transactionId'])) {
            throw new TpayException('Unable to create transaction. Response: '.json_encode($result));
        }

        return $result;
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
            'method' => 'sale',
        ];

        return $this->TpayApi->Transactions->createPaymentByTransactionId($request, $transaction['transactionId']);
    }

    private function processSavedCardPayment($savedCardId)
    {
        $transaction = $this->getNewCardTransaction();
        $exampleCurrentUserId = $this->getCurrentUserId();
        if (!is_numeric($savedCardId)) {
            Logger::log('Invalid saved cardId', 'CardId: '.$savedCardId);

            return header('Location: '.$transaction['transactionPaymentUrl']);
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
        if (false === $isValid) {
            Logger::log(
                'Unauthorized payment try',
                sprintf('User %s has tried to pay by not owned cardId: %s', $exampleCurrentUserId, $requestedCardId)
            );

            // Reject current payment try and redirect user to tpay payment panel new card form
            return header('Location: '.$transaction['transactionPaymentUrl']);
        }
        return $this->payBySavedCard($cardToken, $transaction);
    }

    private function payBySavedCard($cardToken, $transaction)
    {
        $request = [
            'groupId' => 103,
            'cardPaymentData' => [
                'token' => $cardToken,
            ],
            'method' => 'sale',
        ];
        $result = $this->TpayApi->Transactions->createPaymentByTransactionId($request, $transaction['transactionId']);
        if (isset($result['result'], $result['status']) && 'correct' === $result['status']) {
            return $this->setOrderAsComplete($result);
        }
        return header('Location: '.$transaction['transactionPaymentUrl']);
    }

    private function setOrderAsComplete($params)
    {
        // Code setting the order status and other details in your system
        var_dump($params);
    }

    /**
     * Returns stored cards by userId as array. Each row contains card details
     *
     * @param int $userId
     *
     * @return array
     */
    private function getUserSavedCards($userId = 0)
    {
        // Code getting current logged user cards from your DB. This is only an example of DB.
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
        // Code getting the user Id from your system. This is only an example.
        return 2;
    }
}

(new CardGateExtended())->init();
