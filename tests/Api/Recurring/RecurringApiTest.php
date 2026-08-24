<?php

namespace Tpay\Tests\OpenApi\Api\Recurring;

use InvalidArgumentException;
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

    public function testCreateRecurringInProductionModeDoesNotAllowTestPaymentType()
    {
        CurlMock::expectNoCurlExecCall();

        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('paymentType "test" is not allowed in production mode');

        $this->createRecurringApi(true)->createRecurring([
            'paymentInstrument' => [
                'paymentType' => 'test',
                'value' => 'test-value',
            ],
        ]);
    }

    public function testUpdatePaymentInstrumentInProductionModeAllowsTestPaymentType()
    {
        CurlMock::setConsecutiveReturnedTransfers('"ok"');

        $result = $this->createRecurringApi(true)->updatePaymentInstrument([
            'paymentInstrument' => [
                'paymentType' => 'test',
                'value' => 'test-value',
            ],
        ], 'recurring-id');

        self::assertSame('ok', $result);
    }

    public function testCreateRecurringAcceptsAnchorDayInSchedule()
    {
        CurlMock::setConsecutiveReturnedTransfers('"ok"');

        $result = $this->createRecurringApi(false)->createRecurring($this->recurringFields(28));

        self::assertSame('ok', $result);
    }

    public function testCreateRecurringAcceptsNullAnchorDayInSchedule()
    {
        CurlMock::setConsecutiveReturnedTransfers('"ok"');

        $result = $this->createRecurringApi(false)->createRecurring($this->recurringFields(null));

        self::assertSame('ok', $result);
    }

    public function testCreateRecurringDoesNotAllowAnchorDayOutOfRange()
    {
        CurlMock::expectNoCurlExecCall();

        $this->expectException(InvalidArgumentException::class);

        $this->createRecurringApi(false)->createRecurring($this->recurringFields(32));
    }

    /** @param null|int $anchorDay */
    private function recurringFields($anchorDay)
    {
        return [
            'id' => 'rec_12345678901234567890AB',
            'description' => 'Recurring Order AB-CD-12',
            'payer' => [
                'email' => 'jan.kowalski@example.com',
                'name' => 'Jan Kowalski',
            ],
            'schedule' => [
                'amount' => 12.34,
                'currency' => 'PLN',
                'firstChargeDate' => '2025-11-12T12:34:00+02:00',
                'interval' => 1,
                'intervalType' => 'months',
                'anchorDay' => $anchorDay,
            ],
            'paymentInstrument' => [
                'paymentType' => 'card_token',
                'value' => 'card-token-value',
            ],
            'callbackUrl' => 'https://example.com/callback',
        ];
    }

    private function createRecurringApi($productionMode)
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);
        $token->access_token = $accessToken;

        return new RecurringApi($token, $productionMode);
    }
}
