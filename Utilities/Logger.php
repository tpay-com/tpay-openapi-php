<?php

namespace tpaySDK\Utilities;

class Logger
{
    static $loggingEnabled = true;
    static $customLogPatch;

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
        $text = (string)$text;
        $logFilePath = self::getLogPath();
        $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : 'Empty server REMOTE_ADDR';
        $logText = PHP_EOL.'===========================';
        $logText .= PHP_EOL.$title;
        $logText .= PHP_EOL.'===========================';
        $logText .= PHP_EOL.date('Y-m-d H:i:s');
        $logText .= PHP_EOL.'ip: '.$ip;
        $logText .= PHP_EOL;
        $logText .= $text;
        $logText .= PHP_EOL;
        self::checkLogFile($logFilePath);
        file_put_contents($logFilePath, $logText, FILE_APPEND);

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
        $text = (string)$text;
        $logFilePath = self::getLogPath();
        self::checkLogFile($logFilePath);
        file_put_contents($logFilePath, PHP_EOL.$text, FILE_APPEND);

        return true;
    }

    private static function checkLogFile($logFilePath)
    {
        if (!file_exists($logFilePath)) {
            file_put_contents($logFilePath, '<?php exit; ?> '.PHP_EOL);
            chmod($logFilePath, 0644);
        }
        if (!file_exists($logFilePath) || !is_writable($logFilePath)) {
            throw new TpayException('Unable to create or write the log file');
        }
    }

    private static function getLogPath()
    {
        $logFileName = 'log_'.date('Y-m-d').'.php';
        if (!empty(static::$customLogPatch)) {
            $logPath = static::$customLogPatch.$logFileName;
        } else {
            $logPath = dirname(__FILE__).'/../Logs/'.$logFileName;
        }

        return $logPath;
    }
}
