<?php

namespace Tpay\OpenApi\Api;

use RuntimeException;
use Tpay\OpenApi\Curl\Curl;
use Tpay\OpenApi\Dictionary\HttpCodesDictionary;
use Tpay\OpenApi\Manager\Manager;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\OpenApi\Utilities\Logger;
use Tpay\OpenApi\Utilities\TpayException;

class ApiAction
{
    public const TPAY_API_URL_PRODUCTION = 'https://api.tpay.com';
    public const TPAY_API_URL_SANDBOX = 'https://openapi.sandbox.tpay.com';
    public const GET = 'GET';
    public const POST = 'POST';
    public const DELETE = 'DELETE';
    public const PUT = 'PUT';

    public $Manager;
    protected $Curl;

    /** @var Token */
    protected $Token;

    /** @var string */
    protected $apiUrl;

    /** @var bool */
    private $productionMode;

    private $clientName;

    /**
     * @param Token $Token
     * @param bool  $productionMode
     */
    public function __construct($Token, $productionMode)
    {
        $this->productionMode = $productionMode;
        $this->Token = $Token;
        $this->Curl = new Curl();
        $this->Manager = new Manager();
        $this->clientName = 'tpay-com/tpay-openapi-php:1.7.1|PHP:'.phpversion();
        $this->apiUrl = true === $this->productionMode
            ? ApiAction::TPAY_API_URL_PRODUCTION
            : ApiAction::TPAY_API_URL_SANDBOX;
    }

    /** @param string $apiUrl */
    public function overrideApiUrl($apiUrl)
    {
        if (!filter_var($apiUrl, FILTER_VALIDATE_URL)) {
            throw new RuntimeException(sprintf('Invalid URL provided: %s', $apiUrl));
        }

        $this->apiUrl = $apiUrl;

        return $this;
    }

    public function run($requestMethod, $apiMethod, $fields = [], $requestBody = null, $headers = [])
    {
        if (is_array($fields) && count($fields) > 0) {
            $this->Manager
                ->setRequestBody($requestBody)
                ->setFields($fields);
        }

        return $this
            ->sendRequest($apiMethod, $requestMethod, $fields, $headers)
            ->getRequestResult();
    }

    public function download($requestMethod, $apiMethod, $fields = [], $requestBody = null, $headers = [])
    {
        if (is_array($fields) && count($fields) > 0) {
            $this->Manager
                ->setRequestBody($requestBody)
                ->setFields($fields);
        }

        $requestUrl = sprintf(
            '%s%s',
            $this->apiUrl,
            $apiMethod
        );
        if (is_string($this->Token->access_token->getValue()) && '/oauth/auth' !== $apiMethod) {
            $headers[] = sprintf('Authorization: Bearer %s', $this->Token->access_token->getValue());
        }
        if (!empty($fields)) {
            $headers[] = 'Content-Type: application/json';
        }
        Logger::log(
            'Outgoing request',
            vsprintf(
                "URL: %s \n Method: %s \n Fields: %s \n Headers: %s",
                [$requestUrl, $requestMethod, json_encode($fields), json_encode($headers)]
            )
        );
        $fp = $this->Curl
            ->setRequestUrl($requestUrl)
            ->setPostData($fields)
            ->setMethod($requestMethod)
            ->setHeader($headers)
            ->download();
        Logger::log(
            'Request response',
            sprintf("Fields: %s \n HTTP code: %s", json_encode($this->getRequestResult()), $this->getHttpResponseCode())
        );
        $this->checkResponse();

        return $fp;
    }

    /**
     * @param bool $associative
     *
     * @return array|string
     */
    public function getRequestResult($associative = true)
    {
        if (true === $associative) {
            return json_decode($this->Curl->getResult(), true);
        }

        return $this->Curl->getResult();
    }

    public function getHttpResponseMessage()
    {
        return $this->Curl->getHttpResponseMessage();
    }

    /** @return int */
    public function getHttpResponseCode()
    {
        return $this->Curl->getHttpResponseCode();
    }

    public function setClientName($clientName)
    {
        $this->clientName = substr($clientName, 0, 255);
    }

    public function getClientName()
    {
        return $this->clientName;
    }

    protected function sendRequest($apiMethod, $requestMethod, $fields = [], $headers = [])
    {
        $requestUrl = sprintf(
            '%s%s',
            $this->apiUrl,
            $apiMethod
        );
        if (is_string($this->Token->access_token->getValue()) && '/oauth/auth' !== $apiMethod) {
            $headers[] = sprintf('Authorization: Bearer %s', $this->Token->access_token->getValue());
        }
        if (!empty($fields)) {
            $headers[] = 'Content-Type: application/json';
        }

        if ($this->clientName) {
            $headers[] = 'X-Client-Source: '.$this->clientName;
        }

        $headers[] = 'User-Agent: tpay.com PHP SDK Client/'.gethostname().'/'.$this->clientName;

        Logger::log(
            'Outgoing request',
            vsprintf(
                "URL: %s \n Method: %s \n Fields: %s \n Headers: %s",
                [$requestUrl, $requestMethod, json_encode($fields), json_encode($headers)]
            )
        );
        $this->Curl
            ->setRequestUrl($requestUrl)
            ->setPostData($fields)
            ->setMethod($requestMethod)
            ->setHeader($headers)
            ->sendRequest();
        Logger::log(
            'Request response',
            sprintf("Fields: %s \n HTTP code: %s", json_encode($this->getRequestResult()), $this->getHttpResponseCode())
        );
        $this->checkResponse();

        return $this;
    }

    /**
     * @param string $requestUrl
     * @param array  $queryFields
     *
     * @return string
     */
    protected function addQueryFields($requestUrl, $queryFields)
    {
        if (is_array($queryFields) && count($queryFields) > 0) {
            $requestUrl .= '?'.http_build_query($queryFields);
        }

        return $requestUrl;
    }

    private function checkResponse()
    {
        $responseCode = $this->getHttpResponseCode();
        $errorCodesDict = HttpCodesDictionary::HTTP_ERROR_CODES;
        $successCodesDict = HttpCodesDictionary::HTTP_SUCCESS_CODES;
        if (array_key_exists($responseCode, $errorCodesDict) && empty($this->getRequestResult())) {
            throw new TpayException(sprintf('%s', $errorCodesDict[$responseCode]), $responseCode);
        }
        if (!array_key_exists($responseCode, $errorCodesDict) && !array_key_exists($responseCode, $successCodesDict)) {
            throw new TpayException(sprintf('Unknown error response code %s', $responseCode));
        }
    }
}
