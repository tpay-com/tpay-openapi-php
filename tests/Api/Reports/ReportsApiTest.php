<?php

namespace Tpay\Tests\OpenApi\Api\Reports;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Api\Reports\ReportsApi;
use Tpay\OpenApi\Model\Fields\Token\AccessToken;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\Tests\OpenApi\Mock\CurlMock;

/**
 * @covers \Tpay\OpenApi\Api\Reports\ReportsApi
 */
class ReportsApiTest extends TestCase
{
    public function testGetReports()
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);
        $token->access_token = $accessToken;

        $reportsApi = new ReportsApi($token, false);

        CurlMock::setConsecutiveReturnedTransfers('"ok"');

        $result = $reportsApi->getReports();

        self::assertSame('ok', $result);
    }

    public function testGetReportFile()
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);
        $token->access_token = $accessToken;

        $reportsApi = new ReportsApi($token, false);

        CurlMock::setConsecutiveReturnedTransfers('"ok"', '');

        $handle = $reportsApi->getReportFile('ReportId', 'FileId');

        $result = stream_get_contents($handle);

        self::assertSame('"ok"', $result);
    }
}
