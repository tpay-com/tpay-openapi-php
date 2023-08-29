<?php

namespace Tpay\Tests\OpenApi\Mock {
    use PHPUnit\Framework\AssertionFailedError;

    final class CurlMock
    {
        /** @var array<string> */
        private static $returnedTransfers;

        /** @param array<string> $returnedTransfers */
        public static function expectConsecutiveReturnedTransfers(...$returnedTransfers)
        {
            self::$returnedTransfers = $returnedTransfers;
        }

        public static function expectNoCurlExecCall()
        {
            self::$returnedTransfers = [];
        }

        /** @return string */
        public static function getCurlExecResult()
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
        return CurlMock::getCurlExecResult();
    }

    function curl_getinfo()
    {
        return ['http_code' => 200];
    }
}
