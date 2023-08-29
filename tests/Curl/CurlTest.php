<?php

namespace Tpay\Tests\OpenApi\Curl;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Curl\Curl;
use Tpay\Tests\OpenApi\Mock\CurlMock;

/**
 * @covers \Tpay\OpenApi\Curl\Curl
 */
class CurlTest extends TestCase
{
    /**
     * @dataProvider dataGettingHttpResponseMessage
     *
     * @param int    $code
     * @param string $message
     */
    public function testGettingHttpResponseMessage($code, $message)
    {
        $curl = new Curl();
        $curl->setMethod('GET');

        CurlMock::setReturnedHttpCode($code);
        CurlMock::setConsecutiveReturnedTransfers('["transactions"]');

        $curl->init();
        $curl->sendRequest();

        self::assertSame($message, $curl->getHttpResponseMessage());
    }

    public function dataGettingHttpResponseMessage()
    {
        yield [200, 'OK - default successful outcome of the request'];
        yield [404, 'Not Found - object with requested ID could not be found'];
    }
}
