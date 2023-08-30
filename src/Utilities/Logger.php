<?php

namespace Tpay\OpenApi\Utilities;

use Psr\Log\LoggerInterface;

class Logger
{
    /** @var bool */
    static $loggingEnabled = true;

    /** @var null|string */
    static $customLogPatch;

    /** @var null|LoggerInterface */
    private static $logger;

    public static function setLogger(LoggerInterface $logger)
    {
        self::$logger = $logger;
    }

    /** @return FileLogger|LoggerInterface */
    public static function getLogger()
    {
        if (null === self::$logger) {
            return new FileLogger(self::$customLogPatch);
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
        if (false === static::$loggingEnabled) {
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

        self::getLogger()->info($logText);

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
        if (false === static::$loggingEnabled) {
            return false;
        }

        self::getLogger()->info((string) $text);

        return true;
    }
}
