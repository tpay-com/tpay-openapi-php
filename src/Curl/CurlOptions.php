<?php

namespace Tpay\OpenApi\Curl;

class CurlOptions
{
    protected $headers = [];
    private $verifyHost = 0;
    private $timeout = 30;
    private $connectTimeout = 15;
    private $verifyPeer = false;
    private $verbose = true;
    private $post = true;
    private $returnTransfer = true;
    private $failOnError = false;
    private $followLocation = false;

    /**
     * Set timeout time
     *
     * @param int $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Set connect timeout time
     *
     * @param int $timeout
     *
     * @return $this
     */
    public function setConnectTimeout($timeout)
    {
        $this->connectTimeout = $timeout;

        return $this;
    }

    /**
     * Set host verification
     *
     * @param int $verifyHost
     *
     * @return $this
     */
    public function setVerifyHost($verifyHost)
    {
        $this->verifyHost = (int) $verifyHost;

        return $this;
    }

    /**
     * Disable peer verification
     *
     * @return $this
     */
    public function disableVerifyPeer()
    {
        $this->verifyPeer = false;

        return $this;
    }

    /**
     * Disable Verbose
     *
     * @return $this
     */
    public function disableVerbose()
    {
        $this->verbose = false;

        return $this;
    }

    /**
     * Disable POST
     *
     * @return $this
     */
    public function disablePost()
    {
        $this->post = false;

        return $this;
    }

    /**
     * Disable Return Transfer
     *
     * @return $this
     */
    public function disableReturnTransfer()
    {
        $this->returnTransfer = false;

        return $this;
    }

    /**
     * Disable Failing on Error
     *
     * @return $this
     */
    public function disableFailOnError()
    {
        $this->failOnError = false;

        return $this;
    }

    /**
     * Disable Following Location
     *
     * @return $this
     */
    public function disableFollowLocation()
    {
        $this->followLocation = false;

        return $this;
    }

    /**
     * enable peer verification
     *
     * @return $this
     */
    public function enableVerifyPeer()
    {
        $this->verifyPeer = true;

        return $this;
    }

    /**
     * enable Verbose
     *
     * @return $this
     */
    public function enableVerbose()
    {
        $this->verbose = true;

        return $this;
    }

    /**
     * enable POST
     *
     * @return $this
     */
    public function enablePost()
    {
        $this->post = true;

        return $this;
    }

    /**
     * enable Return Transfer
     *
     * @return $this
     */
    public function enableReturnTransfer()
    {
        $this->returnTransfer = true;

        return $this;
    }

    /**
     * enable Failing on Error
     *
     * @return $this
     */
    public function enableFailOnError()
    {
        $this->failOnError = true;

        return $this;
    }

    /**
     * enable Following Location
     *
     * @return $this
     */
    public function enableFollowLocation()
    {
        $this->followLocation = true;

        return $this;
    }

    public function setHeader($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    public function getOptionsArray()
    {
        return [
            CURLOPT_CONNECTTIMEOUT => $this->connectTimeout,
            CURLOPT_FOLLOWLOCATION => $this->followLocation,
            CURLOPT_SSL_VERIFYHOST => $this->verifyHost,
            CURLOPT_SSL_VERIFYPEER => $this->verifyPeer,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_VERBOSE => $this->verbose,
            CURLOPT_POST => $this->post,
            CURLOPT_RETURNTRANSFER => $this->returnTransfer,
            CURLOPT_FAILONERROR => $this->failOnError,
        ];
    }
}
