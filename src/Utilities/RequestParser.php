<?php

namespace Tpay\OpenApi\Utilities;

class RequestParser
{
    /** @return string */
    public function getContentType()
    {
        return $_SERVER['CONTENT_TYPE'];
    }

    /**
     * @throws TpayException
     *
     * @return array
     */
    public function getParsedContent()
    {
        if ('application/json' === $this->getContentType()) {
            $body = file_get_contents('php://input');
            $jsonData = json_decode($body, true);
            if (is_null($jsonData)) {
                throw new TpayException('Invalid JSON body. Json Error: '.json_last_error_msg().' Body: '.$body);
            }

            return $jsonData;
        }

        return $_POST;
    }

    /** @return string */
    public function getPayload()
    {
        return file_get_contents('php://input');
    }

    /**
     * @throws TpayException
     *
     * @return string
     */
    public function getSignature()
    {
        $jws = isset($_SERVER['HTTP_X_JWS_SIGNATURE']) ? $_SERVER['HTTP_X_JWS_SIGNATURE'] : null;
        if (null === $jws) {
            throw new TpayException('Missing JSW header');
        }

        return $jws;
    }
}
