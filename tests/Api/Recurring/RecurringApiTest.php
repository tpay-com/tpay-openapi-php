<?php

namespace Tpay\Tests\OpenApi\Api\Recurring;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Api\Recurring\RecurringApi;
use Tpay\OpenApi\Model\Fields\Token\AccessToken;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\Tests\OpenApi\Mock\CurlMock;
use UnexpectedValueException;

/**
 * @covers \Tpay\OpenApi\Api\Recurring\RecurringApi
 */
class RecurringApiTest extends TestCase
{
    public function testUpdatePaymentInstrumentWithCardTokenDoesNotAllowBlik()
    {
        CurlMock::expectNoCurlExecCall();

        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Field "blik" is not allowed with paymentType "card_token"');

        $this->createRecurringApi(false)->updatePaymentInstrument([
            'paymentInstrument' => [
                'paymentType' => 'card_token',
                'value' => 'card-token-value',
                'blik' => [
                    'model' => 'A',
                ],
            ],
        ], 'recurring-id');
    }

    public function testUpdatePaymentInstrumentWithBlikPayidRequiresBlik()
    {
        CurlMock::expectNoCurlExecCall();

        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Field "blik" is required when paymentType is "blik_payid"');

        $this->createRecurringApi(false)->updatePaymentInstrument([
            'paymentInstrument' => [
                'paymentType' => 'blik_payid',
                'value' => 'blik-payid-value',
            ],
        ], 'recurring-id');
    }

    public function testUpdatePaymentInstrumentWithBlikPayidAllowsBlik()
    {
        CurlMock::setConsecutiveReturnedTransfers('"ok"');

        $result = $this->createRecurringApi(false)->updatePaymentInstrument([
            'paymentInstrument' => [
                'paymentType' => 'blik_payid',
                'value' => 'blik-payid-value',
                'blik' => [
                    'model' => 'A',
                ],
            ],
        ], 'recurring-id');

        self::assertSame('ok', $result);
    }

    public function testProductionModeDoesNotAllowTestPaymentType()
    {
        CurlMock::expectNoCurlExecCall();

        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('paymentType "test" is not allowed in production mode');

        $this->createRecurringApi(true)->updatePaymentInstrument([
            'paymentInstrument' => [
                'paymentType' => 'test',
                'value' => 'test-value',
            ],
        ], 'recurring-id');
    }

    private function createRecurringApi($productionMode)
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);
        $token->access_token = $accessToken;

        return new RecurringApi($token, $productionMode);
    }
}
