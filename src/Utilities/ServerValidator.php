<?php

namespace Tpay\OpenApi\Utilities;

class ServerValidator
{
    public const REMOTE_ADDRESS = 'REMOTE_ADDR';
    public const FORWARDER_ADDRESS = 'HTTP_X_FORWARDED_FOR';

    /** @var bool */
    private $validateForwardedIP;

    /** @var bool */
    private $validateServerIP;

    /** @var array<string> */
    private $secureIP;

    /**
     * @param bool          $validateServerIP
     * @param bool          $validateForwardedIP
     * @param array<string> $secureIP
     */
    public function __construct($validateServerIP, $validateForwardedIP, array $secureIP)
    {
        $this->validateServerIP = $validateServerIP;
        $this->validateForwardedIP = $validateForwardedIP;
        $this->secureIP = $secureIP;
    }

    /**
     * Check if request is called from secure tpay server
     *
     * @return bool
     */
    public function isValid()
    {
        if (!$this->validateServerIP) {
            return true;
        }
        $remoteIP = $this->getServerValue(self::REMOTE_ADDRESS);
        $forwarderIP = $this->getServerValue(self::FORWARDER_ADDRESS);
        if (is_null($remoteIP) && is_null($forwarderIP)) {
            return false;
        }
        if ($this->checkIP($remoteIP)) {
            return true;
        }

        return (bool) ($this->validateForwardedIP && $this->checkIP($forwarderIP));
    }

    /**
     * Get value from $_SERVER array if exists
     *
     * @param string $name
     *
     * @return null|string
     */
    private function getServerValue($name)
    {
        if (isset($_SERVER[$name])) {
            return $_SERVER[$name];
        }
    }

    /**
     * Validate if $ip is secure
     *
     * @param mixed $ip
     *
     * @return bool
     */
    private function checkIP($ip)
    {
        return in_array($ip, $this->secureIP, true);
    }
}
