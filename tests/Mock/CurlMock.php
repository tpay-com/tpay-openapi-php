<?php

namespace Tpay\Tests\OpenApi\Mock {
    final class CurlMock
    {
        /** @var string */
        private static $returnedTransfer;

        /** @param string $returnedTransfer */
        public static function createMock($returnedTransfer)
        {
            self::$returnedTransfer = $returnedTransfer;
        }

        /** @return string */
        public static function getReturnedTransfer()
        {
            return self::$returnedTransfer;
        }
    }
}

namespace Tpay\OpenApi\Curl {
    use Tpay\Tests\OpenApi\Mock\CurlMock;

    function curl_exec()
    {
        return CurlMock::getReturnedTransfer();
    }

    function curl_getinfo()
    {
        return ['http_code' => 200];
    }
}
