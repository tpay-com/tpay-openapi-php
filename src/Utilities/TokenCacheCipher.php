<?php

namespace Tpay\OpenApi\Utilities;

use Exception;

/**
 * Authenticated encryption of values stored in the cache (e.g. OAuth access token),
 * so that cache storage (database, files, Redis) and its error logs never contain the token in plain text.
 *
 * The key is derived from the client secret, which is never stored in the cache.
 * Uses AES-256-GCM (ext-openssl) or XSalsa20-Poly1305 (ext-sodium) as a fallback.
 */
final class TokenCacheCipher
{
    const PREFIX = 'tpay-enc:v1:';
    const OPENSSL_CIPHER = 'aes-256-gcm';
    const OPENSSL_IV_LENGTH = 12;
    const OPENSSL_TAG_LENGTH = 16;

    /** @var string */
    private $key;

    /**
     * @param string $secret  secret not stored in the cache (client secret)
     * @param string $context value binding the key to a specific usage (e.g. cache key)
     */
    public function __construct($secret, $context)
    {
        $this->key = hash_hmac('sha256', 'tpay-openapi-php|token-cache|'.$context, (string) $secret, true);
    }

    /** @return bool */
    public static function isSupported()
    {
        return self::isOpenSslSupported() || self::isSodiumSupported();
    }

    /**
     * @param string $plaintext
     *
     * @return null|string null when encryption is not possible
     */
    public function encrypt($plaintext)
    {
        try {
            if (self::isOpenSslSupported()) {
                $iv = random_bytes(self::OPENSSL_IV_LENGTH);
                $tag = '';
                $ciphertext = openssl_encrypt(
                    $plaintext,
                    self::OPENSSL_CIPHER,
                    $this->key,
                    OPENSSL_RAW_DATA,
                    $iv,
                    $tag,
                    self::PREFIX,
                    self::OPENSSL_TAG_LENGTH
                );
                if (false === $ciphertext) {
                    return null;
                }

                return self::PREFIX.'o:'.base64_encode($iv.$tag.$ciphertext);
            }

            if (self::isSodiumSupported()) {
                $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

                return self::PREFIX.'s:'.base64_encode($nonce.sodium_crypto_secretbox($plaintext, $nonce, $this->key));
            }
        } catch (Exception $exception) {
            return null;
        }

        return null;
    }

    /**
     * @param mixed $payload
     *
     * @return null|string null when payload is not a valid value encrypted with this key
     */
    public function decrypt($payload)
    {
        if (!is_string($payload) || 0 !== strpos($payload, self::PREFIX)) {
            return null;
        }
        $algorithm = substr($payload, strlen(self::PREFIX), 1);
        $raw = base64_decode(substr($payload, strlen(self::PREFIX) + 2), true);
        if (false === $raw) {
            return null;
        }

        if ('o' === $algorithm && self::isOpenSslSupported()) {
            if (strlen($raw) <= self::OPENSSL_IV_LENGTH + self::OPENSSL_TAG_LENGTH) {
                return null;
            }
            $plaintext = openssl_decrypt(
                substr($raw, self::OPENSSL_IV_LENGTH + self::OPENSSL_TAG_LENGTH),
                self::OPENSSL_CIPHER,
                $this->key,
                OPENSSL_RAW_DATA,
                substr($raw, 0, self::OPENSSL_IV_LENGTH),
                substr($raw, self::OPENSSL_IV_LENGTH, self::OPENSSL_TAG_LENGTH),
                self::PREFIX
            );

            return false === $plaintext ? null : $plaintext;
        }

        if ('s' === $algorithm && self::isSodiumSupported()) {
            if (strlen($raw) <= SODIUM_CRYPTO_SECRETBOX_NONCEBYTES) {
                return null;
            }
            $plaintext = sodium_crypto_secretbox_open(
                substr($raw, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES),
                substr($raw, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES),
                $this->key
            );

            return false === $plaintext ? null : $plaintext;
        }

        return null;
    }

    /** @return bool */
    private static function isOpenSslSupported()
    {
        return function_exists('openssl_encrypt')
            && in_array(self::OPENSSL_CIPHER, array_map('strtolower', openssl_get_cipher_methods()), true);
    }

    /** @return bool */
    private static function isSodiumSupported()
    {
        return function_exists('sodium_crypto_secretbox') && defined('SODIUM_CRYPTO_SECRETBOX_NONCEBYTES');
    }
}
