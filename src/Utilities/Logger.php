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
    public static $loggingEnabled = true;

    /**
     * @deprecated
     *
     * @todo: remove in 2.0.0
     *
     * @var null|string
     */
    public static $customLogPatch;

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
     * @param string $title    action name
     * @param string $text     text to save
     * @param mixed  $logLevel
     *
     * @throws TpayException
     *
     * @return bool
     */
    public static function log($title, $text, $logLevel = 'info')
    {
        $logger = self::getLogger();
        if ($logger instanceof NullLogger) {
            return false;
        }
        $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : 'Empty server REMOTE_ADDR';
        $content = [
            'ip' => $ip,
            'title' => $title,
            'date' => date('Y-m-d H:i:s'),
            'message' => SensitiveDataMasker::maskString($text),
            'logLevel' => $logLevel,
        ];
        $logger->log($logLevel, self::withSerializePrecision(function () use ($content) {
            return json_encode($content);
        }));

        return true;
    }

    /**
     * Runs callback with serialize_precision temporarily set to -1 (shortest float representation),
     * then restores the previous value. Failures of ini_set (e.g. disabled function) are silenced.
     *
     * @return mixed callback result
     */
    public static function withSerializePrecision(callable $callback)
    {
        $previous = false;
        if (PHP_VERSION_ID >= 70100 && function_exists('ini_get') && function_exists('ini_set')) {
            $current = @ini_get('serialize_precision');
            if (false !== $current && '-1' !== $current) {
                $previous = @ini_set('serialize_precision', '-1');
            }
        }

        try {
            return $callback();
        } finally {
            if (false !== $previous) {
                @ini_set('serialize_precision', $previous);
            }
        }
    }
}
