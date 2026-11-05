<?php

namespace Tpay\OpenApi\Utilities;

/**
 * Masks credentials, payment instrument data and payer personal data before they are written to logs.
 */
final class SensitiveDataMasker
{
    const MASK = '***';

    /**
     * Keys (normalized: lowercase, without "_" and "-") whose whole value is replaced with the mask.
     * Arrays under these keys (e.g. "payer", "address") are masked entirely.
     */
    const SENSITIVE_KEYS = [
        // credentials
        'clientsecret',
        'accesstoken',
        'refreshtoken',
        'authorization',
        'password',
        'secret',
        'apikey',
        'apipassword',
        // payment instruments
        'bliktoken',
        'blikpaymentdata',
        'card',
        'carddata',
        'cardpaymentdata',
        'cardtoken',
        'token',
        'tokenvalue',
        'tokenpaymentdatatokenvalue',
        'preauthorizedtoken',
        'applepaypaymentdata',
        'googlepaypaymentdata',
        'cvc',
        'cvv',
        'pan',
        'cardnumber',
        // payer / personal data
        'payer',
        'contact',
        'email',
        'payeremail',
        'tremail',
        'phone',
        'surname',
        'address',
        'owneraddress',
        'ownername',
        'street',
        'housenumber',
        'flatnumber',
        'postalcode',
        'taxid',
        'pesel',
        'dateofbirth',
        'serialnumber',
        'ip',
        'useragent',
        'accountnumber',
        'accountno',
        'bankaccount',
        'iban',
    ];

    const SENSITIVE_HEADERS = [
        'authorization',
        'proxyauthorization',
        'cookie',
        'setcookie',
        'xapikey',
    ];

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public static function maskData($data)
    {
        if (is_object($data)) {
            $data = json_decode((string) json_encode($data), true);
        }
        if (!is_array($data)) {
            return $data;
        }

        $result = [];
        foreach ($data as $key => $value) {
            if (is_string($key) && self::isSensitiveKey($key)) {
                $result[$key] = null === $value ? null : self::MASK;

                continue;
            }
            $result[$key] = self::maskData($value);
        }

        return $result;
    }

    /**
     * @param array<string> $headers headers in "Name: value" format
     *
     * @return array<string>
     */
    public static function maskHeaders(array $headers)
    {
        $result = [];
        foreach ($headers as $key => $header) {
            if (!is_string($header) || false === strpos($header, ':')) {
                $result[$key] = $header;

                continue;
            }
            [$name, $value] = explode(':', $header, 2);
            if (!in_array(self::normalize($name), self::SENSITIVE_HEADERS, true)) {
                $result[$key] = $header;

                continue;
            }
            $value = trim($value);
            $scheme = preg_match('/^(Bearer|Basic|Digest)\s/i', $value, $matches) ? $matches[1].' ' : '';
            $result[$key] = sprintf('%s: %s%s', $name, $scheme, self::MASK);
        }

        return $result;
    }

    /**
     * Best-effort masking of free text (e.g. exception messages, already JSON-encoded payloads).
     *
     * @param string $text
     *
     * @return string
     */
    public static function maskString($text)
    {
        if (!is_string($text) || '' === $text) {
            return $text;
        }

        // Bearer / Basic credentials anywhere in the text
        $text = preg_replace('/\b(Bearer|Basic)\s+[A-Za-z0-9\-._~+\/]+=*/i', '$1 '.self::MASK, $text);

        // "key": "value" / "key": 123 in JSON
        $text = preg_replace_callback(
            '/"([A-Za-z0-9_\-]+)"(\s*:\s*)("(?:[^"\\\\]|\\\\.)*"|-?\d+(?:\.\d+)?)/',
            function ($matches) {
                if (!self::isSensitiveKey($matches[1])) {
                    return $matches[0];
                }

                return sprintf('"%s"%s"%s"', $matches[1], $matches[2], self::MASK);
            },
            $text
        );

        // key=value in query strings / form bodies
        return preg_replace_callback(
            '/([?&\s]|^)([A-Za-z0-9_\-]+)=([^&\s"]*)/',
            function ($matches) {
                if (!self::isSensitiveKey($matches[2])) {
                    return $matches[0];
                }

                return $matches[1].$matches[2].'='.self::MASK;
            },
            $text
        );
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    private static function isSensitiveKey($key)
    {
        return in_array(self::normalize($key), self::SENSITIVE_KEYS, true);
    }

    /**
     * @param string $key
     *
     * @return string
     */
    private static function normalize($key)
    {
        return strtolower(str_replace(['_', '-', ' '], '', trim($key)));
    }
}
