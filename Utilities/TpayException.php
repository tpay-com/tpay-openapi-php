<?php
namespace tpaySDK\Utilities;

use Exception;

class TpayException extends Exception
{
    public function __construct($message, $code = 0)
    {
        $message = sprintf('%s in file %s line: %s', $message, $this->getFile(), $this->getLine());
        Logger::log('TpayException', sprintf('%s %s%s%s', $message, PHP_EOL, PHP_EOL, $this->getTraceAsString()));
        $this->message = sprintf('%s : %s', $code, $message);

        return $this->message;
    }

}
