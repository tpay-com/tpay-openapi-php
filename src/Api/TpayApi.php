<?php

namespace Tpay\Api;

use Tpay\Api\Accounts\AccountsApi;
use Tpay\Api\Authorization\AuthorizationApi;
use Tpay\Api\Refunds\RefundsApi;
use Tpay\Api\Transactions\TransactionsApi;
use Tpay\Model\Objects\Authorization\Token;
use Tpay\Utilities\TpayException;

class TpayApi
{
    const TPAY_API = [
        'Accounts' => AccountsApi::class,
        'Authorization' => AuthorizationApi::class,
        'Transactions' => TransactionsApi::class,
        'Refunds' => RefundsApi::class,
    ];

    /**
     * @var AccountsApi
     */
    public $Accounts;

    /**
     * @var AuthorizationApi
     */
    public $Authorization;

    /**
     * @var TransactionsApi
     */
    public $Transactions;

    /**
     * @var RefundsApi
     */
    public $Refunds;

    /**
     * @var Token
     */
    protected $Token;

    private $productionMode;

    public function __construct($clientId, $clientSecret, $productionMode = false, $scope = 'read')
    {
        $this->productionMode = $productionMode;
        if (
            !$this->Token instanceof Token
            || time() > $this->Token->issued_at->getValue() + $this->Token->expires_in->getValue()
        ) {
            $this->authorize($clientId, $clientSecret, $scope);
        }
        $this->createApiInstances();
    }

    /**
     * @param mixed $Token Token
     */
    public function setCustomToken($Token)
    {
        $this->Token = $Token;
        $this->createApiInstances();
    }

    private function createApiInstances()
    {
        foreach (static::TPAY_API as $apiName => $apiClass) {
            $this->$apiName = new $apiClass($this->Token, $this->productionMode);
        }
    }

    private function authorize($clientId, $clientSecret, $scope = null)
    {
        $AuthApi = new AuthorizationApi(new Token(), $this->productionMode);
        $fields = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => $scope,
        ];
        $AuthApi->getNewToken($fields);
        $this->Token = new Token();
        if (200 === $AuthApi->getHttpResponseCode()) {
            $this->Token = $this->Token->setObjectValues($this->Token, $AuthApi->getRequestResult());
        } else {
            throw new TpayException(
                sprintf(
                    'Authorization error. HTTP code: %s, response: %s',
                    $AuthApi->getHttpResponseCode(),
                    json_encode($AuthApi->getRequestResult())
                )
            );
        }
    }
}
