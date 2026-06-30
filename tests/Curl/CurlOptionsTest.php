<?php

namespace Tpay\Tests\OpenApi\Curl;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Curl\CurlOptions;

/**
 * @covers \Tpay\OpenApi\Curl\CurlOptions
 */
class CurlOptionsTest extends TestCase
{
    public function testDefaultTimeoutsAreShort()
    {
        $options = (new CurlOptions())->getOptionsArray();

        self::assertSame(CurlOptions::DEFAULT_CONNECT_TIMEOUT, $options[CURLOPT_CONNECTTIMEOUT]);
        self::assertSame(CurlOptions::DEFAULT_TIMEOUT, $options[CURLOPT_TIMEOUT]);
    }

    public function testTimeoutsCanBeOverridden()
    {
        $options = (new CurlOptions())
            ->setConnectTimeout(15)
            ->setTimeout(30)
            ->getOptionsArray();

        self::assertSame(15, $options[CURLOPT_CONNECTTIMEOUT]);
        self::assertSame(30, $options[CURLOPT_TIMEOUT]);
    }
}
