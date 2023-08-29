<?php

namespace Tpay\OpenApi\Api\Accounts;

use Tpay\OpenApi\Api\ApiAction;
use Tpay\OpenApi\Model\Objects\RequestBody\Account;

class AccountsApi extends ApiAction
{
    /** @param array $queryFields */
    public function getAccounts($queryFields = [])
    {
        $requestUrl = $this->addQueryFields('/accounts', $queryFields);

        return $this->run(static::GET, $requestUrl);
    }

    /** @param string $accountId */
    public function getAccountById($accountId)
    {
        return $this->run(static::GET, sprintf('/accounts/%s', $accountId));
    }

    public function getCategories()
    {
        return $this->run(static::GET, '/accounts/category');
    }

    /** @param string $categoryId */
    public function getCategoryById($categoryId)
    {
        return $this->run(static::GET, sprintf('/accounts/category/%s', $categoryId));
    }

    public function getLegalForms()
    {
        return $this->run(static::GET, '/accounts/legalForm');
    }

    /** @param string $legalFormId */
    public function getLegalFormById($legalFormId)
    {
        return $this->run(static::GET, sprintf('/accounts/legalForm/%s', $legalFormId));
    }

    public function getDocuments()
    {
        return $this->run(static::GET, '/accounts/document');
    }

    /** @param string $documentId */
    public function getDocumentById($documentId)
    {
        return $this->run(static::GET, sprintf('/accounts/document/%s', $documentId));
    }

    /** @param string $accountId */
    public function getBalanceByAccountId($accountId)
    {
        return $this->run(static::GET, sprintf('/accounts/%s/balance', $accountId));
    }

    /** @param array $fields */
    public function createAccount($fields)
    {
        return $this->run(static::POST, '/accounts', $fields, new Account());
    }
}
