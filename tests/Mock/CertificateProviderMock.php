<?php

namespace Tpay\Tests\OpenApi\Mock;

use Tpay\OpenApi\Utilities\phpseclib\File\X509;

class CertificateProviderMock
{
    private $publicKey;
    private $x509;

    public function __construct($publicKey)
    {
        $this->publicKey = $publicKey;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param mixed $certificatePath
     * @param mixed $rootCa
     *
     * @return X509
     */
    public function provide($certificatePath, $rootCa)
    {
        if (null === $this->x509) {
            $x509 = new X509();
            $x509->loadX509($this->publicKey);
            $this->x509 = $x509;
        }

        return $this->x509;
    }
}
