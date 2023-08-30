<?php

namespace Tpay\Tests\OpenApi\Utilities;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
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

        self::assertRegularExpressionMatches(self::getLogPattern(), $logContent);
    }

    public function testLoggingWithPsrLogger()
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects(self::once())
            ->method('info')
            ->with(self::matchesRegularExpression(self::getLogPattern()));

        Logger::setLogger($logger);

        Logger::log('title', 'text');
    }

    public function testDisablingLogging()
    {
        self::assertTrue(Logger::$loggingEnabled);
        Logger::disableLogging();
        self::assertFalse(Logger::$loggingEnabled);
    }

    public function testDisableLogging()
    {
        self::assertNull(Logger::$customLogPatch);
        Logger::setLogPath('/my/own/path/Logs/');
        self::assertSame('/my/own/path/Logs/', Logger::$customLogPatch);
    }

    public static function assertRegularExpressionMatches($pattern, $string)
    {
        if (method_exists(self::class, 'assertMatchesRegularExpression')) {
            self::assertMatchesRegularExpression($pattern, $string);
        } else {
            self::assertRegExp($pattern, $string);
        }
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
