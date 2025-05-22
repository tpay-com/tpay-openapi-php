<?php

namespace Tpay\Tests\OpenApi\Mock;

use Tpay\OpenApi\Utilities\RequestParser;
use Tpay\OpenApi\Utilities\TpayException;

class RequestParserMock extends RequestParser
{
    private $contentType;
    private $data;
    private $payload;
    private $signature;

    public function __construct($contentType, $data, $payload, $signature)
    {
        $this->contentType = $contentType;
        $this->data = $data;
        $this->payload = $payload;
        $this->signature = $signature;
    }

    /** @return string */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @throws TpayException
     *
     * @return array
     */
    public function getParsedContent()
    {
        if (null === $this->data) {
            throw new TpayException('Invalid JSON body. Json Error: '.json_last_error_msg().' Body: '.json_encode($this->data));
        }

        return $this->data;
    }

    /** @return string */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @throws TpayException
     *
     * @return string
     */
    public function getSignature()
    {
        if (null === $this->signature) {
            throw new TpayException('Missing JSW header');
        }

        return $this->signature;
    }
}
