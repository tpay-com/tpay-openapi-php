<?php

namespace Tpay\OpenApi\Utilities;

use Tpay\OpenApi\Utilities\phpseclib\File\X509;

interface CertificateProvider
{
    /**
     * @param string $certificatePath
     * @param string $rootCa
     *
     * @throws TpayException
     *
     * @return X509
     */
    public function provide($certificatePath, $rootCa);
}
