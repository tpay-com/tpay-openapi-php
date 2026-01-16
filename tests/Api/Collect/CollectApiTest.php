<?php

namespace Tpay\Tests\OpenApi\Api\Collect;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Api\Collect\CollectApi;
use Tpay\OpenApi\Model\Fields\Token\AccessToken;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\Tests\OpenApi\Mock\CurlMock;

/**
 * @covers \Tpay\OpenApi\Api\Collect\CollectApi
 */
class CollectApiTest extends TestCase
{
    /** @dataProvider validBankAccountData */
    public function testAddingValidBankAccount($accountNumber, $ownerName, $additionalInformation)
    {
        $collectApi = $this->createCollectApiWithCurlMock('ok');

        $result = $collectApi->addBankAccount($accountNumber, $ownerName, $additionalInformation);

        self::assertSame('ok', $result);
    }

    /** @dataProvider invalidBankAccountData */
    public function testAddingInvalidBankAccount($accountNumber, $ownerName, $additionalInformation, $exception, $exceptionMessage)
    {
        $collectApi = $this->createCollectApiWithCurlMock('error');

        $this->expectException($exception);
        $this->expectExceptionMessage($exceptionMessage);

        $collectApi->addBankAccount($accountNumber, $ownerName, $additionalInformation);
    }

    public function validBankAccountData()
    {
        yield 'Valid bank account' => [
            'accountNumber' => 'PL12345678901234567890123456',
            'ownerName' => 'Jan Kowalski',
            'additionalInformation' => 'Konto firmowe',
        ];

        yield 'Min length owner name' => [
            'accountNumber' => 'PL00000000000000000000000000',
            'ownerName' => '',
            'additionalInformation' => '',
        ];

        yield 'Max length owner name' => [
            'accountNumber' => 'PL99999999999999999999999999',
            'ownerName' => str_repeat('A', 1000),
            'additionalInformation' => str_repeat('B', 1000),
        ];
    }

    public function invalidBankAccountData()
    {
        yield 'Empty account number' => [
            'accountNumber' => '',
            'ownerName' => 'Jan Kowalski',
            'additionalInformation' => 'Konto firmowe',
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Collect\AccountNumber is too short. Min required 28',
        ];

        yield 'Invalid account number format - missing PL prefix' => [
            'accountNumber' => '1234567890123456789012345678',
            'ownerName' => 'Jan Kowalski',
            'additionalInformation' => 'Konto firmowe',
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Collect\AccountNumber is invalid. Should match ^PL\d{26}$ pattern',
        ];

        yield 'Account number too short' => [
            'accountNumber' => 'PL1234567890123456789012345',
            'ownerName' => 'Jan Kowalski',
            'additionalInformation' => 'Konto firmowe',
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Collect\AccountNumber is too short. Min required 28',
        ];

        yield 'Account number too long' => [
            'accountNumber' => 'PL123456789012345678901234567',
            'ownerName' => 'Jan Kowalski',
            'additionalInformation' => 'Konto firmowe',
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Collect\AccountNumber is too long. Max allowed 28',
        ];

        yield 'Owner name too long' => [
            'accountNumber' => 'PL12345678901234567890123456',
            'ownerName' => str_repeat('A', 1001),
            'additionalInformation' => 'Konto firmowe',
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Collect\OwnerName is too long. Max allowed 1000',
        ];

        yield 'Additional information too long' => [
            'accountNumber' => 'PL12345678901234567890123456',
            'ownerName' => 'Jan Kowalski',
            'additionalInformation' => str_repeat('X', 1001),
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Collect\AdditionalInformation is too long. Max allowed 1000',
        ];
    }

    private function createCollectApiWithCurlMock($response)
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);

        $token->access_token = $accessToken;

        $collectApi = new CollectApi($token, false);

        CurlMock::setConsecutiveReturnedTransfers(json_encode($response));

        return $collectApi;
    }
}
