<?php

// phpcs:ignoreFile
namespace tpaySDK\Utilities\phpseclib\Crypt;

if (class_exists('phpseclib3\Crypt\RSA')) {
    if (!class_exists('tpaySDK\Utilities\phpseclib\Crypt\RSA')) {
        abstract class RSA extends \phpseclib3\Crypt\RSA
        {
        }
    }
} elseif (class_exists('phpseclib\Crypt\RSA')) {
    if (!class_exists('tpaySDK\Utilities\phpseclib\Crypt\RSA')) {
        class RSA extends \phpseclib\Crypt\RSA
        {
        }
    }
} else {
    throw new \RuntimeException('Cannot find supported phpseclib/phpseclib library');
}
