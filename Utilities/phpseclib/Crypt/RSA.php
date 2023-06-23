<?php

// phpcs:ignoreFile
namespace tpaySDK\Utilities\phpseclib\Crypt;

if (class_exists('phpseclib3\Crypt\RSA')) {
    class_alias('phpseclib3\Crypt\RSA', RSA::class);
    if (!class_exists(RSA::class)) {
        abstract class RSA extends \phpseclib3\Crypt\RSA
        {
        }
    }
} elseif (class_exists('phpseclib\Crypt\RSA')) {
    class_alias('phpseclib\Crypt\RSA', RSA::class);
    if (!class_exists(RSA::class)) {
        class RSA extends \phpseclib\Crypt\RSA
        {
        }
    }
} else {
    throw new \RuntimeException('Cannot find supported phpseclib/phpseclib library');
}
