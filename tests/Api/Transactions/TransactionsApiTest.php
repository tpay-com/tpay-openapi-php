<?php

namespace Tpay\Tests\OpenApi\Api\Transactions;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Api\Transactions\TransactionsApi;
use Tpay\OpenApi\Model\Fields\Token\AccessToken;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\Tests\OpenApi\Mock\CurlMock;

/**
 * @covers \Tpay\OpenApi\Api\Transactions\TransactionsApi
 */
class TransactionsApiTest extends TestCase
{
    public function testCreatingTransaction()
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);
        $token->access_token = $accessToken;

        $transactionsApi = new TransactionsApi($token, false);

        CurlMock::createMock('"ok"');

        $result = $transactionsApi->createTransaction([
            'amount' => 0.10,
            'description' => 'test transaction',
            'hiddenDescription' => 'order_213',
            'payer' => [
                'email' => 'john.doe@example.com',
                'name' => 'John Doe',
                'phone' => '123456789',
                'address' => 'Long Street 123/2',
                'code' => '11-123',
                'city' => 'New York',
                'country' => 'US',
                'taxId' => 'PL3774716081',
            ],
            'lang' => 'en',
            'callbacks' => [
                'notification' => [
                    'url' => 'https://example.com/notification',
                    'email' => 'merchant@example.com',
                ],
                'payerUrls' => [
                    'success' => 'https://example.com/success',
                    'error' => 'https://example.com/error',
                ],
            ],
        ]);

        self::assertSame('ok', $result);
    }
}
