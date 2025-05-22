<?php

namespace Tpay\OpenApi\Utilities;

use Tpay\OpenApi\Utilities\phpseclib\File\X509;

interface CertificateProvider
{
    /**
     * @param string $certificatePath
     * @param string $rootCa
     *
     * @return X509
     * @throws TpayException
     *
     */
    public function provide($certificatePath, $rootCa);
}