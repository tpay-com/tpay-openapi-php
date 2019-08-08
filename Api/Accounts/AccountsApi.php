<?php
namespace tpaySDK\Api\Accounts;

use tpaySDK\Api\ApiAction;
use tpaySDK\Model\Objects\RequestBody\Account;

class AccountsApi extends ApiAction
{
    public function getAccounts()
    {
        return $this->run(static::GET, '/accounts');
    }

    public function getAccountById($accountId)
    {
        return $this->run(static::GET, sprintf('/accounts/%s', $accountId));
    }

    public function getCategories()
    {
        return $this->run(static::GET, '/accounts/category');
    }

    public function getCategoryById($categoryId)
    {
        return $this->run(static::GET, sprintf('/accounts/category/%s', $categoryId));
    }

    public function getLegalForms()
    {
        return $this->run(static::GET, '/accounts/legalForm');
    }

    public function getLegalFormById($legalFormId)
    {
        return $this->run(static::GET, sprintf('/accounts/legalForm/%s', $legalFormId));
    }

    public function getDocuments()
    {
        return $this->run(static::GET, '/accounts/document');
    }

    public function getDocumentById($documentId)
    {
        return $this->run(static::GET, sprintf('/accounts/document/%s', $documentId));
    }

    public function getBalanceByAccountId($accountId)
    {
        return $this->run(static::GET, sprintf('/accounts/%s/balance', $accountId));
    }

    public function createAccount($fields)
    {
        return $this->run(static::POST, '/accounts', $fields, new Account);
    }

}
