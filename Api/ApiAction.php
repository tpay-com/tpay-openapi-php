<?php
namespace tpaySDK\Api;

use tpaySDK\Curl\Curl;
use tpaySDK\Dictionary\HttpCodesDictionary;
use tpaySDK\Manager\Manager;
use tpaySDK\Model\Objects\Authorization\Token;
use tpaySDK\Utilities\Logger;
use tpaySDK\Utilities\TpayException;

class ApiAction
{
    const TPAY_API_URL_PRODUCTION = 'https://api.tpay.com';

    const TPAY_API_URL_SANDBOX = 'https://api.tpay.com/test';

    const GET = 'GET';

    const POST = 'POST';

    const DELETE = 'DELETE';

    const PUT = 'PUT';

    public $Manager;

    protected $Curl;

    /**
     * @var Token
     */
    protected $Token;

    private $productionMode;

    public function __construct($Token, $productionMode)
    {
        $this->productionMode = $productionMode;
        $this->Token = $Token;
        $this->Curl = new Curl();
        $this->Manager = new Manager();
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

    public function getRequestResult($associative = true)
    {
        if ($associative === true) {
            return json_decode($this->Curl->getResult(), true);
        }

        return $this->Curl->getResult();

    }

    public function getHttpResponseMessage()
    {
        return $this->Curl->getHttpResponseMessage();
    }

    public function getHttpResponseCode()
    {
        return $this->Curl->getHttpResponseCode();
    }

    protected function sendRequest($apiMethod, $requestMethod, $fields = [], $headers = [])
    {
        $requestUrl = sprintf(
            '%s%s',
            $this->productionMode === true ? static::TPAY_API_URL_PRODUCTION : static::TPAY_API_URL_SANDBOX,
            $apiMethod
        );
        if (is_string($this->Token->access_token->getValue()) && $apiMethod !== '/oauth/auth') {
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
