<?php

namespace Tpay\OpenApi\Curl;

use CurlHandle;
use Tpay\OpenApi\Dictionary\HttpCodesDictionary;
use Tpay\OpenApi\Utilities\TpayException;

class Curl extends CurlOptions
{
    /**
     * Last executed cURL info
     *
     * @var array
     */
    private $curlInfo;

    /**
     * Last executed cURL error
     *
     * @var string
     */
    private $curlError;

    /**
     * Last executed cURL errno
     *
     * @var int
     */
    private $curlErrorNumber;

    /** @var string */
    private $url;

    /** @var array */
    private $postData;

    /** @var string */
    private $result;

    /** @var string */
    private $method;

    public function __construct()
    {
        if (!function_exists('curl_init') || !function_exists('curl_exec')) {
            throw new TpayException('cURL function not available');
        }
    }

    /**
     * Get last info
     *
     * @return array
     */
    public function getCurlLastInfo()
    {
        return $this->curlInfo;
    }

    /**
     * Get last Curl error info
     *
     * @return string
     */
    public function getCurlLastError()
    {
        return $this->curlError;
    }

    /**
     * Get last Curl error number info
     *
     * @return int
     */
    public function getCurlLastErrorNo()
    {
        return $this->curlErrorNumber;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setRequestUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param array $postData
     *
     * @return $this
     */
    public function setPostData($postData)
    {
        $this->postData = $postData;

        return $this;
    }

    /**
     * @param string $method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /** @return $this */
    public function sendRequest()
    {
        $ch = $this->init();
        $curlRes = curl_exec($ch);
        $this->curlInfo = curl_getinfo($ch);
        $this->curlError = curl_error($ch);
        $this->curlErrorNumber = curl_errno($ch);
        curl_close($ch);
        $this->result = $curlRes;

        return $this;
    }

    /** @return false|resource */
    public function download()
    {
        $ch = $this->init();
        $fp = tmpfile();
        curl_setopt($ch, CURLOPT_FILE, $fp);
        $curlRes = curl_exec($ch);
        $this->curlInfo = curl_getinfo($ch);
        $this->curlError = curl_error($ch);
        $this->curlErrorNumber = curl_errno($ch);
        curl_close($ch);
        $this->result = $curlRes;
        fseek($fp, 0);

        return $fp;
    }

    /** @return CurlHandle */
    public function init()
    {
        $ch = curl_init();
        foreach ($this->getOptionsArray() as $key => $value) {
            curl_setopt($ch, $key, $value);
        }
        curl_setopt($ch, CURLOPT_URL, $this->url);
        $this->setCurlMethod($ch);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        return $ch;
    }

    /** @return string */
    public function getResult()
    {
        return $this->result;
    }

    public function getHttpResponseMessage()
    {
        $responseCode = $this->getHttpResponseCode();
        $errorCodesDict = HttpCodesDictionary::HTTP_ERROR_CODES;
        $successCodesDict = HttpCodesDictionary::HTTP_SUCCESS_CODES;
        if (array_key_exists($responseCode, $errorCodesDict)) {
            return $errorCodesDict[$responseCode];
        }
        if (array_key_exists($responseCode, $successCodesDict)) {
            return $successCodesDict[$responseCode];
        }

        return 'Not supported response from Tpay server';
    }

    /** @return int */
    public function getHttpResponseCode()
    {
        return (int) $this->curlInfo['http_code'];
    }

    /** @param CurlHandle $curl */
    private function setCurlMethod($curl)
    {
        switch ($this->method) {
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, 1);
                if (!empty($this->postData)) {
                    $json = json_encode($this->postData);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
                }
                break;
            case 'PUT':
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            case 'DELETE':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($this->postData)) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $this->postData);
                }
                break;
            case 'GET':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
                break;
            default:
                throw new TpayException(sprintf('Curl method %s is not allowed', $this->method));
        }
    }
}
