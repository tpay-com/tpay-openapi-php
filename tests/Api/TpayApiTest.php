<?php

namespace Tpay\Tests\OpenApi\Api;

use Doctrine\Common\Cache\ArrayCache;
use PHPUnit\Framework\TestCase;
use PSX\Cache\SimpleCache;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\Tests\OpenApi\Mock\CurlMock;

/**
 * @covers \Tpay\OpenApi\Api\TpayApi
 */
class TpayApiTest extends TestCase
{
    public function testCreatingTpayApiObjectDoesNotCallApi()
    {
        CurlMock::expectNoCurlExecCall();

        $tpayApi = new TpayApi(new Cache(null, new SimpleCache(new ArrayCache())), '123', '');

        CurlMock::setConsecutiveReturnedTransfers(
            '{"client_id": "123"}',
            '["transactions"]'
        );

        $result = $tpayApi->transactions()->getTransactions([]);

        self::assertSame(['transactions'], $result);
    }
}
