<?php

namespace Tpay\Tests\OpenApi\Api;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\Tests\OpenApi\Mock\CurlMock;

/**
 * @covers \Tpay\OpenApi\Api\TpayApi
 */
class TpayApiTest extends TestCase
{
    public function testCreatingTpayApiObjectDoesNotCallApi()
    {
        CurlMock::expectNoCurlExecCall();

        $tpayApi = new TpayApi('123', '');

        CurlMock::setConsecutiveReturnedTransfers(
            '{"client_id": "123"}',
            '["transactions"]'
        );

        $result = $tpayApi->transactions()->getTransactions([]);

        self::assertSame(['transactions'], $result);
    }

    public function testUsingPropertyTriggersDeprecation()
    {
        $tpayApi = new TpayApi('123', '');

        set_error_handler(static function ($errno, $errstr) {
            restore_error_handler();
            throw new RuntimeException($errstr);
        }, E_USER_DEPRECATED);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Using property "Transactions" is deprecated and will be removed in 2.0.0. Call the method "transactions()"');

        $tpayApi->Transactions->getTransactions([]);
    }
}
