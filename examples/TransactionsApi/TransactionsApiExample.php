<?php

namespace TpayExample\TransactionsApi;

use Tpay\Api\TpayApi;
use TpayExample\ExamplesConfig;

require_once '../ExamplesConfig.php';
require_once '../../src/Loader.php';

class TransactionsApiExample extends ExamplesConfig
{
    private $TpayApi;

    public function __construct()
    {
        parent::__construct();
        $this->TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');
    }

    public function runAllExamples()
    {
        $this
            ->getTransactions()
            ->getBankGroups()
            ->getChannels()
            ->createBasicTransaction(150)
            ->createTransactionWithInstantRedirection(4)
            ->createSavedCardTransaction()
            ->createNewCardTransaction()
            ->createBlikTransaction();
    }

    public function getBankGroups()
    {
        $bankGroups = $this->TpayApi->Transactions->getBankGroups();
        var_dump($bankGroups);

        return $this;
    }

    public function getChannels()
    {
        $bankGroups = $this->TpayApi->Transactions->getChannels();
        var_dump($bankGroups);

        return $this;
    }

    public function getTransactions()
    {
        $transactions = $this->TpayApi->Transactions->getTransactions();
        var_dump($transactions);

        return $this;
    }

    public function getTransactionById($transactionId)
    {
        $transaction = $this->TpayApi->Transactions->getTransactionById($transactionId);
        var_dump($transaction);

        return $this;
    }

    // Create transaction with a specified bank group id
    public function createBasicTransaction($bankGroupId)
    {
        $transactionParameters = $this->getTransactionParameters();
        $transactionParameters['pay'] = ['groupId' => $bankGroupId];
        $newTransaction = $this->TpayApi->Transactions->createTransaction($transactionParameters);
        var_dump($newTransaction);

        return $this;
    }

    // Create transaction with a specified channel id and instant redirection
    public function createTransactionWithInstantRedirection($channelId)
    {
        $transactionParameters = $this->getTransactionParameters();
        $transactionParameters['pay'] = ['channelId' => $channelId];
        $newTransaction = $this->TpayApi->Transactions->createTransactionWithInstantRedirection($transactionParameters);
        var_dump($newTransaction);

        return $this;
    }

    // Create transaction with the BLIK payment
    public function createBlikTransaction()
    {
        $transactionParameters = $this->getTransactionParameters();
        $transactionParameters['pay'] = $this->getBlikPaymentParameters();
        $newTransaction = $this->TpayApi->Transactions->createTransaction($transactionParameters);
        var_dump($newTransaction);

        return $this;
    }

    // Create transaction with a new card
    public function createNewCardTransaction()
    {
        $transactionParameters = $this->getTransactionParameters();
        $transactionParameters['pay'] = $this->getNewCardPaymentParameters();
        $newTransaction = $this->TpayApi->Transactions->createTransaction($transactionParameters);
        var_dump($newTransaction);

        return $this;
    }

    // Create transaction with a saved card
    public function createSavedCardTransaction()
    {
        $transactionParameters = $this->getTransactionParameters();
        $transactionParameters['pay'] = $this->getSavedCardPaymentParameters();
        $newTransaction = $this->TpayApi->Transactions->createTransaction($transactionParameters);
        var_dump($newTransaction);

        return $this;
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

    protected function getBlikPaymentParameters()
    {
        return [
            'groupId' => 150,
            'blikPaymentData' => [
                'blikToken' => '123456', // This must be a string
                'aliases' => [
                    'value' => 'test__custom_alias_123',
                    'type' => 'UID',
                ],
                'type' => 0,
            ],
        ];
    }

    protected function getNewCardPaymentParameters()
    {
        return [
            'groupId' => 103,
            'cardPaymentData' => [
                'card' => 'drBWwFVDf\/OtqVogY5wYJMlUY\/Y\/OFr9Z8SZtyCq0pwXy+1kMUjVuUadtF7wGtSnr2kGxqpgoYrHSFmSl9N8DRj\/nxw8P+8MJgt0w1fMuwlcIPwUQMloYvfhFf9WG0B3xbIafngsOTsUXngcDIlGJySM\/zsU1+xW1EvQrFvsmzM=',
                'save' => true,
            ],
        ];
    }

    protected function getSavedCardPaymentParameters()
    {
        return [
            'groupId' => 103,
            'cardPaymentData' => [
                'token' => 't59c2810d59285e3e0ee9d1f1eda1c2f4c554e24',
            ],
        ];
    }
}

(new TransactionsApiExample())->runAllExamples();
