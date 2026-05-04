<?php

namespace Tpay\Tests\OpenApi\Api\Blik;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Api\Blik\BlikApi;
use Tpay\OpenApi\Model\Fields\Token\AccessToken;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\Tests\OpenApi\Mock\CurlMock;

/**
 * @covers \Tpay\OpenApi\Api\Blik\BlikApi
 */
class BlikApiTest extends TestCase
{
    /** @dataProvider dataCreateAlias */
    public function testCreateAlias(array $fields)
    {
        $blikApi = $this->createBlikApiWithCurlMock('"ok"');

        $result = $blikApi->createAlias($fields);

        self::assertSame('ok', $result);
    }

    public function testGetAlias()
    {
        $blikApi = $this->createBlikApiWithCurlMock('"ok"');

        $result = $blikApi->getAlias('some-alias-value', 'PAYID');

        self::assertSame('ok', $result);
    }

    public function testDeleteAlias()
    {
        $blikApi = $this->createBlikApiWithCurlMock('"ok"');

        $result = $blikApi->deleteAlias('some-alias-value', ['aliasType' => 'PAYID']);

        self::assertSame('ok', $result);
    }

    public static function dataCreateAlias()
    {
        $fields = [
            'description' => 'YourGroceryShop payments',
            'pay' => [
                'blikPaymentData' => [
                    'blikToken' => '123456',
                    'type' => 0,
                ],
            ],
        ];

        yield 'without lang' => [$fields];

        $fields['lang'] = 'pl';

        yield 'with lang' => [$fields];

        $fields['pay']['blikPaymentData']['aliases'] = [
            'value' => 'TPAY_ALIAS_1',
            'type' => 'PAYID',
            'label' => 'YourGroceryShop, the best shop for your grocery needs',
            'autopayment' => [
                'model' => 'A',
                'frequency' => '17D',
                'singleLimitAmount' => 100,
                'totalLimitAmount' => 1000,
                'currency' => 'PLN',
                'initDate' => '2025-01-01T00:00:00+00:00',
                'expirationDate' => '2028-01-01T00:00:00+00:00',
            ],
        ];

        yield 'with aliases and autopayment' => [$fields];

        $fields['pay']['blikPaymentData']['type'] = 2;
        unset($fields['pay']['blikPaymentData']['blikToken']);

        yield 'autopayment type 2 without blikToken' => [$fields];
    }

    private function createBlikApiWithCurlMock($response)
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);
        $token->access_token = $accessToken;

        $blikApi = new BlikApi($token, false);

        CurlMock::setConsecutiveReturnedTransfers($response);

        return $blikApi;
    }
}
