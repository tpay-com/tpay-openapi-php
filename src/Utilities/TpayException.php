<?php

namespace Tpay\OpenApi\Utilities;

use Exception;
use Psr\Log\LogLevel;

class TpayException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code = 0)
    {
        $message = sprintf('%s in file %s line: %s', $message, $this->getFile(), $this->getLine());
        Logger::log('TpayException',
            sprintf('%s %s%s%s', $message, PHP_EOL, PHP_EOL, $this->getTraceAsString()),
            LogLevel::ERROR
        );
        $this->message = sprintf('%s : %s', $code, $message);

        return $this->message;
    }
}
