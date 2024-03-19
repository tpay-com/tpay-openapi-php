<?php

namespace Tpay\OpenApi\Api;

use RuntimeException;
use Tpay\OpenApi\Api\Accounts\AccountsApi;
use Tpay\OpenApi\Api\Authorization\AuthorizationApi;
use Tpay\OpenApi\Api\Refunds\RefundsApi;
use Tpay\OpenApi\Api\Reports\ReportsApi;
use Tpay\OpenApi\Api\Transactions\TransactionsApi;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\OpenApi\Utilities\TpayException;

class TpayApi
{
    /** @deprecated will be removed in 2.0.0 */
    const TPAY_API = [
        'Accounts' => AccountsApi::class,
        'Authorization' => AuthorizationApi::class,
        'Transactions' => TransactionsApi::class,
        'Refunds' => RefundsApi::class,
        'Reports' => ReportsApi::class,
    ];

    /** @var null|AccountsApi */
    private $accounts;

    /** @var null|AuthorizationApi */
    private $authorization;

    /** @var null|RefundsApi */
    private $refunds;

    /** @var null|ReportsApi */
    private $reports;

    /** @var null|TransactionsApi */
    private $transactions;

    /** @var null|Token */
    private $token;

    /** @var string */
    private $clientId;

    /** @var string */
    private $clientSecret;

    /** @var bool */
    private $productionMode;

    /** @var string */
    private $scope;

    /** @var string */
    private $apiUrl;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param bool $productionMode
     * @param string $scope
     * @param null|string $apiUrlOverride
     */
    public function __construct($clientId, $clientSecret, $productionMode = false, $scope = 'read', $apiUrlOverride = null)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->productionMode = $productionMode;
        $this->scope = $scope;
        $this->apiUrl = true === $this->productionMode
            ? ApiAction::TPAY_API_URL_PRODUCTION
            : ApiAction::TPAY_API_URL_SANDBOX;
        if (null !== $apiUrlOverride) {
            if (!filter_var($apiUrlOverride, FILTER_VALIDATE_URL)) {
                throw new RuntimeException(sprintf('Invalid URL provided: %s', $apiUrlOverride));
            }
            $this->apiUrl = $apiUrlOverride;
        }
    }

    /**
     * @param string $propertyName
     *
     * @return AccountsApi|AuthorizationApi|RefundsApi|TransactionsApi
     */
    public function __get($propertyName)
    {
        @trigger_error(
            sprintf(
                'Using property "%s" is deprecated and will be removed in 2.0.0. Call the method "%s()".',
                $propertyName,
                lcfirst($propertyName)
            ),
            E_USER_DEPRECATED
        );

        switch ($propertyName) {
            case 'Accounts':
                return $this->accounts();
            case 'Authorization':
                return $this->authorization();
            case 'Refunds':
                return $this->refunds();
            case 'Transactions':
                return $this->transactions();
        }

        throw new RuntimeException(sprintf('Property %s::%s does not exist!', __CLASS__, $propertyName));
    }

    /** @param Token $token */
    public function setCustomToken($token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    /** @return AccountsApi */
    public function accounts()
    {
        $this->authorize();
        if (null === $this->accounts) {
            $this->accounts = (new AccountsApi($this->token, $this->productionMode))
                ->overrideApiUrl($this->apiUrl);
        }

        return $this->accounts;
    }

    /** @return AuthorizationApi */
    public function authorization()
    {
        $this->authorize();
        if (null === $this->authorization) {
            $this->authorization = (new AuthorizationApi($this->token, $this->productionMode))
                ->overrideApiUrl($this->apiUrl);
        }

        return $this->authorization;
    }

    /** @return RefundsApi */
    public function refunds()
    {
        $this->authorize();
        if (null === $this->refunds) {
            $this->refunds = (new RefundsApi($this->token, $this->productionMode))
                ->overrideApiUrl($this->apiUrl);
        }

        return $this->refunds;
    }

    /** @return ReportsApi */
    public function reports()
    {
        $this->authorize();
        if (null === $this->reports) {
            $this->reports = (new ReportsApi($this->token, $this->productionMode))
                ->overrideApiUrl($this->apiUrl);
        }

        return $this->reports;
    }

    /** @return TransactionsApi */
    public function transactions()
    {
        $this->authorize();
        if (null === $this->transactions) {
            $this->transactions = (new TransactionsApi($this->token, $this->productionMode))
                ->overrideApiUrl($this->apiUrl);
        }

        return $this->transactions;
    }

    private function authorize()
    {
        if (
            $this->token instanceof Token
            && time() <= $this->token->issued_at->getValue() + $this->token->expires_in->getValue()
        ) {
            return;
        }

        $authApi = (new AuthorizationApi(new Token(), $this->productionMode))->overrideApiUrl($this->apiUrl);
        $fields = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope' => $this->scope,
        ];
        $authApi->getNewToken($fields);

        if (200 !== $authApi->getHttpResponseCode()) {
            throw new TpayException(
                sprintf(
                    'Authorization error. HTTP code: %d, response: %s',
                    $authApi->getHttpResponseCode(),
                    json_encode($authApi->getRequestResult())
                )
            );
        }

        $this->token = new Token();
        $this->token->setObjectValues($this->token, $authApi->getRequestResult());
    }
}
