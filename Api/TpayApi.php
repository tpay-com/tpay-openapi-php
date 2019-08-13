<?php
namespace tpaySDK\Api;

use tpaySDK\Api\Accounts\AccountsApi;
use tpaySDK\Api\Transactions\TransactionsApi;
use tpaySDK\Api\Authorization\AuthorizationApi;
use tpaySDK\Utilities\TpayException;

class TpayApi
{
    const TPAY_API = [
        'Accounts' => AccountsApi::class,
        'Authorization' => AuthorizationApi::class,
        'Transactions' => TransactionsApi::class,
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

    private $token;

    private $productionMode;

    public function __construct($clientId, $clientSecret, $productionMode = false, $scope = 'read')
    {
        $this->productionMode = $productionMode;
        if (is_null($this->token)
            ||
            (isset($this->token['issued_at']) && time() > $this->token['issued_at'] + $this->token['expires_in'])
        ) {
            $this->authorize($clientId, $clientSecret, $scope);
        }
        $this->createApiInstances();
    }

    public function setCustomToken($token)
    {
        $this->token = $token;
        $this->createApiInstances();
    }

    private function createApiInstances()
    {
        foreach (static::TPAY_API as $apiName => $apiClass) {
            $this->$apiName = new $apiClass($this->token, $this->productionMode);
        }
    }

    private function authorize($clientId, $clientSecret, $scope = null)
    {
        $AuthApi = new AuthorizationApi(null, $this->productionMode);
        $fields = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => $scope,
        ];
        $AuthApi->getNewToken($fields);
        if ($AuthApi->getHttpResponseCode() === 200) {
            $this->token = $AuthApi->getRequestResult();
        } else {
            throw new TpayException(sprintf(
                    'Authorization error. HTTP code %s Response: %s',
                    $AuthApi->getHttpResponseCode(),
                    json_encode($AuthApi->getRequestResult())
                )
            );
        }
    }

}
