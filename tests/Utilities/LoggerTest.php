<?php

namespace Tpay\Tests\OpenApi\Utilities;

use PHPUnit\Framework\Constraint\RegularExpression;
use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Utilities\Logger;

/**
 * @covers \Tpay\OpenApi\Utilities\Logger
 */
class LoggerTest extends TestCase
{
    public function testDefaultLoggingToFile()
    {
        $logPath = __DIR__.'/../../src/Logs/log_'.date('Y-m-d').'.php';
        if (file_exists($logPath)) {
            unlink($logPath);
        }

        Logger::log('title', 'text');

        $logContent = file_get_contents($logPath);

        self::assertThat($logContent, new RegularExpression(self::getLogPattern()));
    }

    /** @return string */
    private static function getLogPattern()
    {
        return '/
===========================
title
===========================
\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}
ip: Empty server REMOTE_ADDR
text
$/i';
    }
}
