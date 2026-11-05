<?php

namespace Tpay\Tests\OpenApi\Utilities;

use Doctrine\Common\Cache\ArrayCache;
use PHPUnit\Framework\TestCase;
use PSX\Cache\Pool;
use PSX\Cache\SimpleCache;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\OpenApi\Utilities\TokenCacheCipher;
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
                    'issued_at' => time(),
                    'scope' => 'read',
                    'token_type' => 'Bearer',
                    'expires_in' => 7200,
                    'client_id' => '12345-132123',
                    'access_token' => '01G6WAPZFNNX4CXBPKQH5MYD4H1857b07a64af14',
                ]
            )
        );

        $result = $tpayApi->authorization();
        $fields = [
            'client_id' => '12345-132123',
            'client_secret' => '456',
            'scope' => 'read',
        ];
        $cacheKey = sha1(json_encode($fields).'https://openapi.sandbox.tpay.com');

        self::assertTrue($pool->getItem($cacheKey)->isHit());
        self::assertEncryptedToken($pool->getItem($cacheKey)->get(), $cacheKey);
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
                    'issued_at' => time(),
                    'scope' => 'read',
                    'token_type' => 'Bearer',
                    'expires_in' => 7200,
                    'client_id' => '12345-132123',
                    'access_token' => '01G6WAPZFNNX4CXBPKQH5MYD4H1857b07a64af14',
                ]
            )
        );

        $result = $tpayApi->authorization();
        $fields = [
            'client_id' => '12345-132123',
            'client_secret' => '456',
            'scope' => 'read',
        ];
        $cacheKey = sha1(json_encode($fields).'https://openapi.sandbox.tpay.com');

        self::assertEncryptedToken($cache->get($cacheKey), $cacheKey);
    }

    public function testCachedTokenIsReusedWithoutNewAuthorization()
    {
        $cache = new SimpleCache(new ArrayCache());
        CurlMock::setReturnedHttpCode(200);
        CurlMock::setConsecutiveReturnedTransfers(
            json_encode(
                [
                    'issued_at' => time(),
                    'scope' => 'read',
                    'token_type' => 'Bearer',
                    'expires_in' => 7200,
                    'client_id' => '12345-132123',
                    'access_token' => 'reused-access-token',
                ]
            )
        );
        (new TpayApi(new Cache(null, $cache), '12345-132123', '456'))->authorization();

        CurlMock::expectNoCurlExecCall();
        $tpayApi = new TpayApi(new Cache(null, $cache), '12345-132123', '456');
        $tpayApi->authorization();

        self::assertInstanceOf(Token::class, $tpayApi->getToken());
        self::assertSame('reused-access-token', $tpayApi->getToken()->access_token->getValue());
    }

    public function testLegacyUnencryptedTokenInCacheIsIgnored()
    {
        $cache = new SimpleCache(new ArrayCache());
        $fields = [
            'client_id' => '12345-132123',
            'client_secret' => '456',
            'scope' => 'read',
        ];
        $cacheKey = sha1(json_encode($fields).'https://openapi.sandbox.tpay.com');
        $legacyToken = new Token();
        $legacyToken->setObjectValues($legacyToken, ['issued_at' => time(), 'expires_in' => 7200, 'access_token' => 'legacy']);
        $cache->set($cacheKey, $legacyToken, 7100);

        CurlMock::setReturnedHttpCode(200);
        CurlMock::setConsecutiveReturnedTransfers(
            json_encode(
                [
                    'issued_at' => time(),
                    'scope' => 'read',
                    'token_type' => 'Bearer',
                    'expires_in' => 7200,
                    'client_id' => '12345-132123',
                    'access_token' => 'fresh-access-token',
                ]
            )
        );
        $tpayApi = new TpayApi(new Cache(null, $cache), '12345-132123', '456');
        $tpayApi->authorization();

        self::assertSame('fresh-access-token', $tpayApi->getToken()->access_token->getValue());
        self::assertEncryptedToken($cache->get($cacheKey), $cacheKey);
    }

    /**
     * @param mixed  $cachedValue
     * @param string $cacheKey
     */
    private static function assertEncryptedToken($cachedValue, $cacheKey)
    {
        self::assertIsStringValue($cachedValue);
        self::assertStringStartsWith(TokenCacheCipher::PREFIX, $cachedValue);
        self::assertFalse(strpos($cachedValue, 'access_token'));
        self::assertFalse(strpos($cachedValue, '01G6WAPZFNNX4CXBPKQH5MYD4H1857b07a64af14'));

        $decrypted = json_decode((new TokenCacheCipher('456', $cacheKey))->decrypt($cachedValue), true);
        self::assertSame('12345-132123', $decrypted['client_id']);
        self::assertArrayHasKey('access_token', $decrypted);
    }

    /** @param mixed $value */
    private static function assertIsStringValue($value)
    {
        self::assertTrue(is_string($value), 'Cached token should be an encrypted string');
    }

    public function testExceptionWhenNoCacheGiven()
    {
        $this->expectException(TpayException::class);
        new Cache();
    }
}
