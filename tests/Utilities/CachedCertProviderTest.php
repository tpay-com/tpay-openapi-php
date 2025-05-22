<?php

namespace Tpay\Tests\OpenApi\Utilities;

use Doctrine\Common\Cache\ArrayCache;
use PHPUnit\Framework\TestCase;
use PSX\Cache\Pool;
use PSX\Cache\SimpleCache;
use SodiumException;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\OpenApi\Utilities\CacheCertificateProvider;
use Tpay\OpenApi\Utilities\TpayException;
use Tpay\Tests\OpenApi\Mock\CurlMock;

/**
 * @covers \Tpay\OpenApi\Utilities\Logger
 */
class CachedCertProviderTest extends TestCase
{
    public function testCertProvider()
    {
        $cache = new Cache(new Pool(new ArrayCache()));

        $x5u = 'https://secure.tpay.com/x509/notifications-jws.pem';
        $rootCa = 'https://secure.tpay.com/x509/tpay-jws-root.pem';

        $provider = new CacheCertificateProvider($cache);
        $provider->provide($x5u, $rootCa);

        $this->assertStringContainsString('CERTIFICATE', $cache->get('cert_' . md5($x5u)));
        $this->assertStringContainsString('CERTIFICATE', $cache->get('trusted_' . md5($rootCa)));

        $cache->set('cert_' . md5($x5u), 'x5u', 10);
        $cache->set('trusted_' . md5($rootCa), 'trusted', 10);

        $this->expectException(SodiumException::class);
        $provider->provide($x5u, $rootCa);
    }
}
