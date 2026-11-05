<?php

namespace Tpay\Tests\OpenApi\Utilities;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Utilities\TokenCacheCipher;

/**
 * @covers \Tpay\OpenApi\Utilities\TokenCacheCipher
 */
class TokenCacheCipherTest extends TestCase
{
    public function testEncryptDecryptRoundTrip()
    {
        $cipher = new TokenCacheCipher('client-secret', 'cache-key');

        $encrypted = $cipher->encrypt('{"access_token":"abc"}');

        self::assertStringStartsWith(TokenCacheCipher::PREFIX, $encrypted);
        self::assertFalse(strpos($encrypted, 'abc'));
        self::assertSame('{"access_token":"abc"}', $cipher->decrypt($encrypted));
    }

    public function testDecryptWithDifferentSecretFails()
    {
        $encrypted = (new TokenCacheCipher('client-secret', 'cache-key'))->encrypt('payload');

        self::assertNull((new TokenCacheCipher('other-secret', 'cache-key'))->decrypt($encrypted));
        self::assertNull((new TokenCacheCipher('client-secret', 'other-key'))->decrypt($encrypted));
    }

    public function testTamperedOrForeignPayloadIsRejected()
    {
        $cipher = new TokenCacheCipher('client-secret', 'cache-key');
        $encrypted = $cipher->encrypt('payload');
        $tampered = substr($encrypted, 0, -2).('AA' === substr($encrypted, -2) ? 'BB' : 'AA');

        self::assertNull($cipher->decrypt($tampered));
        self::assertNull($cipher->decrypt('plain value'));
        self::assertNull($cipher->decrypt(null));
        self::assertNull($cipher->decrypt(new \stdClass()));
    }
}
