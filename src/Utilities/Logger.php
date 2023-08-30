<?php

namespace Tpay\OpenApi\Utilities;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Logger
{
    /**
     * @deprecated
     *
     * @todo: remove in 2.0.0
     *
     * @var bool
     */
    static $loggingEnabled = true;

    /**
     * @deprecated
     *
     * @todo: remove in 2.0.0
     *
     * @var null|string
     */
    static $customLogPatch;

    /** @var null|string */
    private static $customLogPath;

    /** @var null|FileLogger|LoggerInterface */
    private static $logger;

    public static function disableLogging()
    {
        self::$logger = new NullLogger();
        self::$loggingEnabled = false; // @todo: remove in 2.0.0
    }

    /** @param string $logPath */
    public static function setLogPath($logPath)
    {
        self::$customLogPatch = $logPath; // @todo: remove in 2.0.0
        self::$customLogPath = $logPath;
    }

    public static function setLogger(LoggerInterface $logger)
    {
        self::$logger = $logger;
    }

    /** @return FileLogger|LoggerInterface */
    public static function getLogger()
    {
        if (!self::$loggingEnabled) { // @todo: remove the condition in 2.0.0
            self::$logger = new NullLogger();
        }

        if (null === self::$logger) {
            self::$logger = new FileLogger(self::$customLogPatch); // @todo: replace with self::$customLogPath in 2.0.0
        }

        return self::$logger;
    }

    /**
     * Save text to log file
     *
     * @param string $title action name
     * @param string $text  text to save
     *
     * @throws TpayException
     *
     * @return bool
     */
    public static function log($title, $text)
    {
        $logger = self::getLogger();
        if ($logger instanceof NullLogger) {
            return false;
        }

        $text = (string) $text;
        $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : 'Empty server REMOTE_ADDR';
        $logText = PHP_EOL.'===========================';
        $logText .= PHP_EOL.$title;
        $logText .= PHP_EOL.'===========================';
        $logText .= PHP_EOL.date('Y-m-d H:i:s');
        $logText .= PHP_EOL.'ip: '.$ip;
        $logText .= PHP_EOL;
        $logText .= $text;
        $logText .= PHP_EOL;

        $logger->info($logText);

        return true;
    }

    /**
     * Save one line to log file
     *
     * @param string $text text to save
     *
     * @return bool
     */
    public static function logLine($text)
    {
        $logger = self::getLogger();
        if ($logger instanceof NullLogger) {
            return false;
        }

        $logger->info((string) $text);

        return true;
    }
}
