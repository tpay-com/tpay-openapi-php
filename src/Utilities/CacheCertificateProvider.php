<?php

namespace Tpay\OpenApi\Utilities;

use Tpay\OpenApi\Utilities\phpseclib\File\X509;

class CacheCertificateProvider implements CertificateProvider
{
    /**
     * @var Cache
     */
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param string $certificatePath
     * @param string $rootCa
     *
     * @return X509
     * @throws TpayException
     *
     */
    public function provide($certificatePath, $rootCa)
    {
        $certificate = $this->cache->get('cert_'.md5($certificatePath));
        if (!$certificate) {
            $certificate = $this->getFile($certificatePath);
            $this->cache->set('cert_'.md5($certificatePath), $certificate, 7200);
        }
        $trusted = $this->cache->get('trusted_'.md5($certificatePath));
        if (!$trusted) {
            $trusted = $this->getFile($rootCa);
            $this->cache->set('trusted_'.md5($rootCa), $trusted, 7200);
        }

        $x509 = new X509();
        $x509->loadX509($certificate);
        $x509->loadCA($trusted);

        if (!$x509->validateSignature()) {
            $this->cache->delete('cert_'.md5($certificatePath));
            $this->cache->delete('trusted_'.md5($rootCa));
            throw new TpayException('Signing certificate is not signed by Tpay CA certificate');
        }

        return $x509;
    }

    public function clearCachedCerts($certificatePath, $rootCa)
    {
        $this->cache->delete('cert_'.md5($certificatePath));
        $this->cache->delete('trusted_'.md5($rootCa));
    }

    /**
     * @param string $url
     *
     * @return bool|string
     * @throws TpayException
     *
     */
    private function getFile($url)
    {
        $content = @file_get_contents($url);
        if ($content) {
            return $content;
        }
        if (!function_exists('curl_init')) {
            throw TpayException::curlNotAvailable();
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
