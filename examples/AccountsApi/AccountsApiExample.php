<?php

namespace Tpay\Example\AccountsApi;

use Doctrine\Common\Cache\FilesystemCache;
use PSX\Cache\SimpleCache;
use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Utilities\Cache;

final class AccountsApiExample extends ExamplesConfig
{
    private $TpayApi;

    public function __construct()
    {
        parent::__construct();
        $cache = new Cache(null, new SimpleCache(new FilesystemCache(__DIR__.'/cache/')));
        $this->TpayApi = new TpayApi($cache, self::PARTNER_CLIENT_ID, self::PARTNER_CLIENT_SECRET, true, 'read');
    }

    public function runAllExamples()
    {
        $this
            ->createAccount()
            ->getAccounts()
            ->getCategories()
            ->getCategoryById(60)
            ->getDocuments()
            ->getDocumentById(1)
            ->getLegalForms()
            ->getLegalFormById(16);
    }

    public function getAccounts()
    {
        $accounts = $this->TpayApi->accounts()->getAccounts();
        var_dump($accounts);

        return $this;
    }

    public function getAccountById($accountId)
    {
        $account = $this->TpayApi->accounts()->getAccountById($accountId);
        var_dump($account);

        return $this;
    }

    public function getCategories()
    {
        $categories = $this->TpayApi->accounts()->getCategories();
        var_dump($categories);

        return $this;
    }

    public function getCategoryById($categoryId)
    {
        $category = $this->TpayApi->accounts()->getCategoryById($categoryId);
        var_dump($category);

        return $this;
    }

    public function getDocuments()
    {
        $documents = $this->TpayApi->accounts()->getDocuments();
        var_dump($documents);

        return $this;
    }

    public function getDocumentById($documentId)
    {
        $document = $this->TpayApi->accounts()->getDocumentById($documentId);
        var_dump($document);

        return $this;
    }

    public function getLegalForms()
    {
        $legalForms = $this->TpayApi->accounts()->getLegalForms();
        var_dump($legalForms);

        return $this;
    }

    public function getLegalFormById($legalFormId)
    {
        $legalForm = $this->TpayApi->accounts()->getLegalFormById($legalFormId);
        var_dump($legalForm);

        return $this;
    }

    public function createAccount()
    {
        $accountConfig = $this->getNewAccountConfig();
        $newAccount = $this->TpayApi->accounts()->createAccount($accountConfig);
        var_dump($newAccount);

        return $this;
    }

    public function createMerchant()
    {
        $merchantConfig = $this->getNewMerchantConfig();
        $newMerchant = $this->TpayApi->accounts()->createMerchant($merchantConfig);
        var_dump($newMerchant);

        return $this;
    }

    private function getNewAccountConfig()
    {
        $offerCode = 'PTON8';
        $personContact = [
            'type' => 2,
            'contact' => '(0)111222333',
        ];
        $pos = [
            'name' => 'Przykladowe Zakupy Online',
            'description' => 'Zakupy online - rtv i agd',
            'url' => 'https://przykladowezakupy.pl',
        ];
        $address1 = [
            'friendlyName' => 'Adres Korespondencyjny',
            'name' => 'Example Sp. z o.o.',
            'street' => 'Ul. Jelenia',
            'houseNumber' => '123',
            'postalCode' => '54-134',
            'city' => 'Warszawa',
            'country' => 'PL',
        ];
        $person = [
            'name' => 'Jan',
            'surname' => 'Kowalski',
            'isRepresentative' => true,
            'isContactPerson' => true,
            'contact' => [
                $personContact,
            ],
        ];

        return [
            'offerCode' => $offerCode,
            'email' => 'merchant@example.com',
            'taxId' => '7773061579',
            'legalForm' => 3,
            'categoryId' => 62,
            'website' => [$pos],
            'address' => [$address1],
            'person' => [$person],
            'notifyByEmail' => true,
        ];
    }

    private function getNewMerchantConfig()
    {
        $offerCode = 'PTON8';
        $pos = [
            'name' => 'Przykladowe Zakupy Online',
            'url' => 'https://przykladowezakupy.pl',
        ];
        $address1 = [
            'name' => 'Example Sp. z o.o.',
            'street' => 'Ul. Jelenia',
            'houseNumber' => '123',
            'postalCode' => '54-134',
            'city' => 'Warszawa',
            'country' => 'PL',
        ];
        $contactPerson = [
            'name' => 'Jan',
            'surname' => 'Kowalski',
            'phone' => '(0) 111222333',
            'email' => 'jan.kowalski@example.com',
        ];

        return [
            'offerCode' => $offerCode,
            'email' => 'merchant@example.com',
            'taxId' => '7773061579',
            'legalForm' => 3,
            'categoryId' => 62,
            'website' => [$pos],
            'address' => [$address1],
            'person' => [$contactPerson],
        ];
    }
}

(new AccountsApiExample())->runAllExamples();
