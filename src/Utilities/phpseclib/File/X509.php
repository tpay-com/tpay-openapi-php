<?php

namespace Tpay\OpenApi\Utilities\phpseclib\File;

use RuntimeException;

if (class_exists('phpseclib4\File\X509')) {
    class X509
    {
        /** @var \phpseclib4\File\X509 */
        private $x509;

        /**
         * @param string $cert
         *
         * @return \phpseclib4\File\X509
         */
        public function loadX509($cert)
        {
            $this->x509 = \phpseclib4\File\X509::load($cert);

            return $this->x509;
        }

        /**
         * @param string $cert
         */
        public function loadCA($cert)
        {
            // phpseclib 4 keeps trust anchors in a static store. Reset it so each
            // provider call trusts only the CA it was given, matching v2/v3.
            \phpseclib4\File\X509::clearCAStore();
            \phpseclib4\File\X509::addCA($cert);
        }

        /**
         * @return bool
         */
        public function validateSignature()
        {
            return $this->x509->validateSignature();
        }

        public function getPublicKey()
        {
            return $this->x509->getPublicKey();
        }

        public function withSettings($publicKey, $hash, $signature)
        {
            return $publicKey->withHash($hash)->withPadding($signature);
        }
    }
} elseif (class_exists('phpseclib3\File\X509')) {
    class X509 extends \phpseclib3\File\X509
    {
        public function withSettings($publicKey, $hash, $signature)
        {
            return $publicKey->withHash($hash)->withPadding($signature);
        }
    }
} elseif (class_exists('phpseclib\File\X509')) {
    class X509 extends \phpseclib\File\X509
    {
        public function withSettings($publicKey, $hash, $signature)
        {
            $publicKey->setHash($hash);
            $publicKey->setSignatureMode($signature);

            return $publicKey;
        }
    }
} else {
    throw new RuntimeException('Cannot find supported phpseclib/phpseclib library');
}
