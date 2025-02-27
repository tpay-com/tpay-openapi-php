<?php

namespace Tpay\OpenApi\Utilities;

use Tpay\OpenApi\Utilities\phpseclib\File\X509;

class CertificateProvider
{
    /**
     * @param string $certificatePath
     *
     * @throws TpayException
     *
     * @return X509
     */
    public function provide($certificatePath, $rootCa)
    {
        $certificate = file_get_contents($certificatePath);
        $trusted = file_get_contents($rootCa);

        if (empty($certificate) || empty($trusted)) {
            $certificate = $this->fallbackGetContents($certificatePath);
            $trusted = $this->fallbackGetContents($rootCa);
        }

        $x509 = new X509();
        $x509->loadX509($certificate);
        $x509->loadCA($trusted);

        if (!$x509->validateSignature()) {
            throw new TpayException('Signing certificate is not signed by Tpay CA certificate');
        }

        return $x509;
    }

    /**
     * @param string $url
     *
     * @throws TpayException
     *
     * @return bool|string
     */
    private function fallbackGetContents($url)
    {
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
