<?php

namespace Tpay\OpenApi\Utilities;

class RequestParser
{
    /** @var null|string */
    private $rawBody;

    /** @return string */
    public function getContentType()
    {
        return isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
    }

    /**
     * @throws TpayException
     *
     * @return array
     */
    public function getParsedContent()
    {
        if (false !== strpos($this->getContentType(), 'application/json')) {
            $body = $this->getRawBody();
            $jsonData = json_decode($body, true);

            if (is_null($jsonData)) {
                throw new TpayException(
                    'Invalid JSON body. Json Error: '.json_last_error_msg().' Body: '.$body
                );
            }

            return $jsonData;
        }

        return $_POST;
    }

    /** @return string */
    public function getPayload()
    {
        return $this->getRawBody();
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

    private function getRawBody()
    {
        if (null === $this->rawBody) {
            $this->rawBody = file_get_contents('php://input');
        }

        return $this->rawBody;
    }
}
