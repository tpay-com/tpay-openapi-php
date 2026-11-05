<?php

namespace Tpay\OpenApi\Api;

use Exception;
use Psr\Log\LogLevel;
use RuntimeException;
use Tpay\OpenApi\Api\Accounts\AccountsApi;
use Tpay\OpenApi\Api\Authorization\AuthorizationApi;
use Tpay\OpenApi\Api\Blik\BlikApi;
use Tpay\OpenApi\Api\Collect\CollectApi;
use Tpay\OpenApi\Api\Recurring\RecurringApi;
use Tpay\OpenApi\Api\Refunds\RefundsApi;
use Tpay\OpenApi\Api\Reports\ReportsApi;
use Tpay\OpenApi\Api\Transactions\TransactionsApi;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\OpenApi\Utilities\Logger;
use Tpay\OpenApi\Utilities\SensitiveDataMasker;
use Tpay\OpenApi\Utilities\TokenCacheCipher;
use Tpay\OpenApi\Utilities\TpayException;

class TpayApi
{
    /** @var null|BlikApi */
    private $blik;

    /** @var null|AccountsApi */
    private $accounts;

    /** @var null|AuthorizationApi */
    private $authorization;

    /** @var null|CollectApi */
    private $collect;

    /** @var null|RecurringApi */
    private $recurring;

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

    /** @return BlikApi */
    public function blik()
    {
        $this->authorize();
        if (null === $this->blik) {
            $this->blik = (new BlikApi($this->token, $this->productionMode))
                ->overrideApiUrl($this->apiUrl);

            if ($this->clientName) {
                $this->blik->setClientName($this->clientName);
            }
        }

        return $this->blik;
    }

    /** @return AccountsApi */
    public function accounts()
    {
        $this->authorize();
        if (null === $this->accounts) {
            $this->accounts = (new AccountsApi($this->token, $this->productionMode))
                ->overrideApiUrl($this->apiUrl);

            $this->accounts->setClientId($this->clientId);
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

            $this->authorization->setClientId($this->clientId);
            if ($this->clientName) {
                $this->authorization->setClientName($this->clientName);
            }
        }

        return $this->authorization;
    }

    /** @return RecurringApi */
    public function recurring()
    {
        $this->authorize();
        if (null === $this->recurring) {
            $this->recurring = (new RecurringApi($this->token, $this->productionMode))
                ->overrideApiUrl($this->apiUrl);

            if ($this->clientName) {
                $this->recurring->setClientName($this->clientName);
            }
        }

        return $this->recurring;
    }

    /** @return RefundsApi */
    public function refunds()
    {
        $this->authorize();
        if (null === $this->refunds) {
            $this->refunds = (new RefundsApi($this->token, $this->productionMode))
                ->overrideApiUrl($this->apiUrl);

            $this->refunds->setClientId($this->clientId);
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

            $this->reports->setClientId($this->clientId);
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

            $this->transactions->setClientId($this->clientId);
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

            $this->collect->setClientId($this->clientId);
            if ($this->clientName) {
                $this->collect->setClientName($this->clientName);
            }
        }

        return $this->collect;
    }

    private function authorize()
    {
        $fields = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope' => $this->scope,
        ];
        $cacheKey = sha1(json_encode($fields).$this->apiUrl);
        $cipher = new TokenCacheCipher($this->clientSecret, $cacheKey);

        $this->token = $this->getCachedToken($cacheKey, $cipher);

        if (
            $this->token instanceof Token
            && time() <= $this->token->issued_at->getValue() + $this->token->expires_in->getValue()
        ) {
            return;
        }

        $authApi = (new AuthorizationApi(new Token(), $this->productionMode))->overrideApiUrl($this->apiUrl);

        $authApi->setClientId($this->clientId);
        if ($this->clientName) {
            $authApi->setClientName($this->clientName);
        }

        $authApi->getNewToken($fields);

        if (200 !== $authApi->getHttpResponseCode()) {
            throw new TpayException(
                sprintf(
                    'Authorization error. HTTP code: %d, response: %s',
                    $authApi->getHttpResponseCode(),
                    json_encode(SensitiveDataMasker::maskData($authApi->getRequestResult()))
                )
            );
        }

        $this->token = new Token();
        $this->token->setObjectValues($this->token, $authApi->getRequestResult());
        $this->cacheToken($cacheKey, $cipher, $this->token);
    }

    /**
     * @param string $cacheKey
     *
     * @return null|Token
     */
    private function getCachedToken($cacheKey, TokenCacheCipher $cipher)
    {
        if (!TokenCacheCipher::isSupported()) {
            return null;
        }

        try {
            // Values stored by previous SDK versions (unencrypted Token objects) are ignored and overwritten
            $tokenJson = $cipher->decrypt($this->cache->get($cacheKey));
            if (null === $tokenJson) {
                return null;
            }
            $tokenData = json_decode($tokenJson, true);
            if (!is_array($tokenData)) {
                return null;
            }
            $token = new Token();
            $token->setObjectValues($token, $tokenData);

            return $token;
        } catch (Exception $exception) {
            Logger::log('Token cache', 'Unable to read token from cache: '.get_class($exception), LogLevel::WARNING);

            return null;
        }
    }

    /** @param string $cacheKey */
    private function cacheToken($cacheKey, TokenCacheCipher $cipher, Token $token)
    {
        if (!TokenCacheCipher::isSupported()) {
            Logger::log(
                'Token cache',
                'Token is not cached: neither ext-openssl (aes-256-gcm) nor ext-sodium is available',
                LogLevel::WARNING
            );

            return;
        }

        $tokenData = [];
        foreach (array_keys(Token::OBJECT_FIELDS) as $fieldName) {
            if ($token->wasFieldProvided($fieldName)) {
                $tokenData[$fieldName] = $token->{$fieldName}->getValue();
            }
        }
        $encryptedToken = $cipher->encrypt((string) json_encode($tokenData));
        if (null === $encryptedToken) {
            Logger::log('Token cache', 'Token is not cached: encryption failed', LogLevel::WARNING);

            return;
        }

        try {
            $this->cache->set($cacheKey, $encryptedToken, 7100);
        } catch (Exception $exception) {
            // Caching is an optimisation only - do not fail the API call and do not propagate cache errors
            Logger::log('Token cache', 'Unable to store token in cache: '.get_class($exception), LogLevel::WARNING);
        }
    }
}
