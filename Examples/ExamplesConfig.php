<?php

namespace tpaySDK\Examples;

use Tpay\Loader;

class ExamplesConfig
{
    // Ask Tpay to get Partner access
    const PARTNER_CLIENT_ID = '';
    const PARTNER_CLIENT_SECRET = '';
    const MERCHANT_CLIENT_ID = '1010-e5736adfd4bc5d8c';
    const MERCHANT_CLIENT_SECRET = '493e01af815383a687b747675010f65d1eefaeb42f63cfe197e7b30f14a556b7';
    const MERCHANT_CONFIRMATION_CODE = 'demo';
    const MERCHANT_RSA_KEY = 'LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0NCk1JR2ZNQTBHQ1NxR1NJYjNEUUVCQVFVQUE0R05BRENCaVFLQmdRQ2NLRTVZNU1Wemd5a1Z5ODNMS1NTTFlEMEVrU2xadTRVZm1STS8NCmM5L0NtMENuVDM2ekU0L2dMRzBSYzQwODRHNmIzU3l5NVpvZ1kwQXFOVU5vUEptUUZGVyswdXJacU8yNFRCQkxCcU10TTVYSllDaVQNCmVpNkx3RUIyNnpPOFZocW9SK0tiRS92K1l1YlFhNGQ0cWtHU0IzeHBhSUJncllrT2o0aFJDOXk0WXdJREFRQUINCi0tLS0tRU5EIFBVQkxJQyBLRVktLS0tLQ==';

    public function __construct()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $this->loadLibrary();
    }

    private function loadLibrary()
    {
        $Loader = new Loader();
        $Loader->loadDependencies();
    }
}
