<?php

namespace Tpay\Tests\OpenApi\Mock {
    use PHPUnit\Framework\AssertionFailedError;

    final class CurlMock
    {
        /** @var int */
        private static $returnedHttpCode = 200;

        /** @var array<string> */
        private static $returnedTransfers;

        /** @param int $returnedHttpCode */
        public static function setReturnedHttpCode($returnedHttpCode)
        {
            self::$returnedHttpCode = $returnedHttpCode;
        }

        /** @param array<string> $returnedTransfers */
        public static function setConsecutiveReturnedTransfers(...$returnedTransfers)
        {
            self::$returnedTransfers = $returnedTransfers;
        }

        /** @return int */
        public static function getReturnedHttpCode()
        {
            return self::$returnedHttpCode;
        }

        public static function expectNoCurlExecCall()
        {
            self::$returnedTransfers = [];
        }

        /** @return string */
        public static function getExecResult()
        {
            if ([] === self::$returnedTransfers) {
                throw new AssertionFailedError('Function "curl_exec" in Tpay\\OpenApi\\Curl\\Curl should not be called!');
            }

            return array_shift(self::$returnedTransfers);
        }
    }
}

namespace Tpay\OpenApi\Curl {
    use Tpay\Tests\OpenApi\Mock\CurlMock;

    /**
     * @return string
     */
    function curl_exec()
    {
        return CurlMock::getExecResult();
    }

    /**
     * @return array{http_code: int}
     */
    function curl_getinfo()
    {
        return ['http_code' => CurlMock::getReturnedHttpCode()];
    }
}
