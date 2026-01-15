<?php

namespace Tpay\OpenApi\Api;

use RuntimeException;
use Tpay\OpenApi\Api\Accounts\AccountsApi;
use Tpay\OpenApi\Api\Authorization\AuthorizationApi;
use Tpay\OpenApi\Api\Collect\CollectApi;
use Tpay\OpenApi\Api\Refunds\RefundsApi;
use Tpay\OpenApi\Api\Reports\ReportsApi;
use Tpay\OpenApi\Api\Transactions\TransactionsApi;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\OpenApi\Utilities\TpayException;

class TpayApi
{
    /** @var null|AccountsApi */
    private $accounts;

    /** @var null|AuthorizationApi */
    private $authorization;

    /** @var null|CollectApi */
    private $collect;

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

    /** @var null|string */
    private $clientName;

    /** @var Cache */
    private $cache;

    public function __construct(
        Cache $cache,
        string $clientId,
        string $clientSecret,
        bool $productionMode = false,
        ?string $apiUrlOverride = null,
        ?string $clientName = null
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->productionMode = $productionMode;
        $this->scope = 'read';
        $this->apiUrl = true === $this->productionMode
            ? ApiAction::TPAY_API_URL_PRODUCTION
            : ApiAction::TPAY_API_URL_SANDBOX;
        $this->clientName = $clientName;
        if (null !== $apiUrlOverride) {
            if (!filter_var($apiUrlOverride, FILTER_VALIDATE_URL)) {
                throw new RuntimeException(sprintf('Invalid URL provided: %s', $apiUrlOverride));
            }
            $this->apiUrl = $apiUrlOverride;
        }
        $this->cache = $cache;
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

            if ($this->clientName) {
                $this->accounts->setClientName($this->clientName);
            }
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

            if ($this->clientName) {
                $this->authorization->setClientName($this->clientName);
            }
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

            if ($this->clientName) {
                $this->refunds->setClientName($this->clientName);
            }
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

            if ($this->clientName) {
                $this->reports->setClientName($this->clientName);
            }
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

            if ($this->clientName) {
                $this->transactions->setClientName($this->clientName);
            }
        }

        return $this->transactions;
    }

    /** @return CollectApi */
    public function collect()
    {
        $this->authorize();
        if (null === $this->collect) {
            $this->collect = (new CollectApi($this->token, $this->productionMode))
                ->overrideApiUrl($this->apiUrl);

            if ($this->clientName) {
                $this->collect->setClientName($this->clientName);
            }
        }
    }

    private function authorize()
    {
        $fields = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope' => $this->scope,
        ];
        $cacheKey = sha1(json_encode($fields).$this->apiUrl);

        $this->token = $this->cache->get($cacheKey);

        if (
            $this->token instanceof Token
            && time() <= $this->token->issued_at->getValue() + $this->token->expires_in->getValue()
        ) {
            return;
        }

        $authApi = (new AuthorizationApi(new Token(), $this->productionMode))->overrideApiUrl($this->apiUrl);

        if ($this->clientName) {
            $authApi->setClientName($this->clientName);
        }

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
        $this->cache->set($cacheKey, $this->token, 7100);
    }
}
