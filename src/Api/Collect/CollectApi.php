<?php

namespace Tpay\OpenApi\Api\Collect;

use Tpay\OpenApi\Api\ApiAction;
use Tpay\OpenApi\Model\Objects\RequestBody\CollectBankAccount;

class CollectApi extends ApiAction
{
    public function getBankAccounts($page = 1, $limit = 35)
    {
        $requestUrl = $this->addQueryFields('/collect/bank-accounts', ['page' => $page, 'limit' => $limit]);

        return $this->sendRequest(static::GET, $requestUrl);
    }

    public function addBankAccount($accountNumber, $ownerName, $additionalInformation)
    {
        $fields = [
            'accountNumber' => $accountNumber,
            'ownerName' => $ownerName,
            'additionalInformation' => $additionalInformation,
        ];

        return $this->run(static::POST, '/collect/bank-accounts', $fields, new CollectBankAccount());
    }
}
