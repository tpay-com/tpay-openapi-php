<?php

namespace Tpay\Tests\OpenApi\Utilities;

use Doctrine\Common\Cache\ArrayCache;
use Exception;
use PHPUnit\Framework\TestCase;
use PSX\Cache\Pool;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\OpenApi\Utilities\CacheCertificateProvider;

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

        $this->assertTrue(strpos($cache->get('cert_'.md5($x5u)), 'CERTIFICATE')>0);
        $this->assertTrue(strpos($cache->get('trusted_'.md5($rootCa)), 'CERTIFICATE')>0);

        $cache->set('cert_'.md5($x5u), 'x5u', 10);
        $cache->set('trusted_'.md5($rootCa), 'trusted', 10);

        $exceptionThrown = false;
        try {
            $provider->provide($x5u, $rootCa);
        }catch(Exception $e){
            $exceptionThrown = true;
        }
        $this->assertTrue($exceptionThrown);
    }
}
