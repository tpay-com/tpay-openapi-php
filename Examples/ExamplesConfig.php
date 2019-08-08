<?php
namespace tpaySDK\Examples;

use tpaySDK\Loader;

class ExamplesConfig
{
    //Ask Tpay to get Partner access
    const PARTNER_CLIENT_ID = '';

    const PARTNER_CLIENT_SECRET = '';

    const MERCHANT_CLIENT_ID = '';

    const MERCHANT_CLIENT_SECRET = '';

    const MERCHANT_CONFIRMATION_CODE = '';

    const MERCHANT_RSA_KEY = '';

    public function __construct()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $this->loadLibrary();
    }

    private function loadLibrary()
    {
        $Loader = new Loader;
        $Loader->loadDependencies();
    }

}
