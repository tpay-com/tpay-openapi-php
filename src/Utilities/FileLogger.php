<?php

namespace Tpay\OpenApi\Utilities;

class FileLogger
{
    /** @var null|string */
    private $logFilePath;

    /** @param null|string $logFilePath */
    public function __construct($logFilePath)
    {
        $this->logFilePath = $logFilePath;
    }

    /** @param string $message */
    public function info($message)
    {
        $logFilePath = $this->getLogPath();
        self::checkLogFile($logFilePath);
        file_put_contents($logFilePath, $message, FILE_APPEND);
    }

    /** @return string */
    private function getLogPath()
    {
        $logFileName = 'log_'.date('Y-m-d').'.php';
        if (null !== $this->logFilePath) {
            $logPath = $this->logFilePath.$logFileName;
        } else {
            $logPath = __DIR__.'/../Logs/'.$logFileName;
        }

        return $logPath;
    }

    /** @param string $logFilePath */
    private function checkLogFile($logFilePath)
    {
        if (!file_exists($logFilePath)) {
            file_put_contents($logFilePath, '<?php exit; ?> '.PHP_EOL);
            chmod($logFilePath, 0644);
        }
        if (!file_exists($logFilePath) || !is_writable($logFilePath)) {
            throw new TpayException('Unable to create or write the log file');
        }
    }
}
