<?php

namespace Tpay\Example;

use Tpay\OpenApi\Loader;
use Tpay\OpenApi\Utilities\Util;

class ExamplesConfig
{
    // Ask Tpay to get Partner access
    const PARTNER_CLIENT_ID = '';
    const PARTNER_CLIENT_SECRET = '';
    const MERCHANT_CLIENT_ID = '--put--your--client--id--here';
    const MERCHANT_CLIENT_SECRET = '--put--your--client--secret--here';
    const MERCHANT_CONFIRMATION_CODE = '--put--your--confirmation-code--here';
    const MERCHANT_RSA_KEY = '--put--your--RSA-key--here';

    public function __construct()
    {
        Util::$libraryPath = '/src/';
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $this->loadLibrary();
        if (self::MERCHANT_CLIENT_ID === '--put--your--client--id--here') {
            die('Please fill your API credentials in file: '.__DIR__);
        }
    }

    private function loadLibrary()
    {
        $Loader = new Loader();
        $Loader->loadDependencies();
    }
}
