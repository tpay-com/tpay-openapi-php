<?php

namespace Tpay\Tests\OpenApi\Utilities;

use Doctrine\Common\Cache\ArrayCache;
use PHPUnit\Framework\TestCase;
use PSX\Cache\Pool;
use PSX\Cache\SimpleCache;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\OpenApi\Utilities\TpayException;
use Tpay\Tests\OpenApi\Mock\CurlMock;

/**
 * @covers \Tpay\OpenApi\Utilities\Logger
 */
class CacheTest extends TestCase
{
    public function testPsr6TokenCache()
    {
        CurlMock::expectNoCurlExecCall();

        $pool = new Pool(new ArrayCache());
        $tpayApi = new TpayApi(new Cache($pool), '12345-132123', '456');

        CurlMock::setReturnedHttpCode(200);
        CurlMock::setConsecutiveReturnedTransfers(
            json_encode(
                [
                    "issued_at" => time(),
                    "scope" => "read",
                    "token_type" => "Bearer",
                    "expires_in" => 7200,
                    "client_id" => "12345-132123",
                    "access_token" => "01G6WAPZFNNX4CXBPKQH5MYD4H1857b07a64af14"
                ]
            )
        );

        $result = $tpayApi->authorization();
        $fields = [
            'client_id' => '12345-132123',
            'client_secret' => '456',
            'scope' => 'read',
        ];
        $cacheKey = sha1(json_encode($fields) . 'https://openapi.sandbox.tpay.com');

        self::assertTrue($pool->getItem($cacheKey)->isHit());
        self::assertInstanceOf(Token::class, $pool->getItem($cacheKey)->get());
        $pool->deleteItem($cacheKey);
    }

    public function testPsr16TokenCache()
    {
        CurlMock::expectNoCurlExecCall();

        $cache = new SimpleCache(new ArrayCache());
        $tpayApi = new TpayApi(new Cache(null, $cache), '12345-132123', '456');


        CurlMock::setReturnedHttpCode(200);
        CurlMock::setConsecutiveReturnedTransfers(
            json_encode(
                [
                    "issued_at" => time(),
                    "scope" => "read",
                    "token_type" => "Bearer",
                    "expires_in" => 7200,
                    "client_id" => "12345-132123",
                    "access_token" => "01G6WAPZFNNX4CXBPKQH5MYD4H1857b07a64af14"
                ]
            )
        );

        $result = $tpayApi->authorization();
        $fields = [
            'client_id' => '12345-132123',
            'client_secret' => '456',
            'scope' => 'read',
        ];
        $cacheKey = sha1(json_encode($fields) . 'https://openapi.sandbox.tpay.com');

        self::assertInstanceOf(Token::class, $cache->get($cacheKey));
    }

    public function testExceptionWhenNoCacheGiven()
    {
        $this->expectException(TpayException::class);
        new Cache();
    }
}
