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

    public function log($level, $message, array $context = [])
    {
        $this->info($message);
    }


    /** @param string $message */
    protected function info($message)
    {
        $content = json_decode($message, true);
        $logText = PHP_EOL . '===========================';
        $logText .= PHP_EOL . $content['title'];
        $logText .= PHP_EOL . '===========================';
        $logText .= PHP_EOL . $content['date'];
        $logText .= PHP_EOL . 'ip: ' . $content['ip'];
        $logText .= PHP_EOL;
        $logText .= $content['message'];
        $logText .= PHP_EOL;

        $logFilePath = $this->getLogPath();
        self::checkLogFile($logFilePath);
        file_put_contents($logFilePath, $logText, FILE_APPEND);
    }

    /** @return string */
    private function getLogPath()
    {
        $logFileName = 'log_' . date('Y-m-d') . '.php';
        if (null !== $this->logFilePath) {
            $logPath = $this->logFilePath . $logFileName;
        } else {
            $logPath = __DIR__ . '/../Logs/' . $logFileName;
        }

        return $logPath;
    }

    /** @param string $logFilePath */
    private function checkLogFile($logFilePath)
    {
        if (!file_exists($logFilePath)) {
            file_put_contents($logFilePath, '<?php exit; ?> ' . PHP_EOL);
            chmod($logFilePath, 0644);
        }
        if (!file_exists($logFilePath) || !is_writable($logFilePath)) {
            throw new \Exception('Unable to create or write the log file');
        }
    }
}
