<?php

namespace Tpay\OpenApi\Locale;

use Tpay\OpenApi\Utilities\TpayException;

class Lang extends Keys
{
    public static $currentLanguage = 'en';

    /**
     * Change current language
     *
     * @param string $lang language code
     *
     * @throws TpayException
     */
    public static function setLang($lang)
    {
        if (empty(static::$translations)) {
            self::initializeTranslations();
        }

        if (array_key_exists($lang, static::$translations)) {
            static::$currentLanguage = $lang;
        } else {
            throw new TpayException('This language is not supported: '.$lang);
        }
    }

    /**
     * Get and print translated string
     *
     * @param mixed $key
     */
    public static function lang($key)
    {
        echo static::get($key);
    }

    /**
     * Get translated string
     *
     * @param string $key
     *
     * @return string
     */
    public static function get($key)
    {
        return static::$translations[static::$currentLanguage][$key];
    }
}
