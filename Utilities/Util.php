<?php

namespace tpaySDK\Utilities;

use tpaySDK\Locale\Lang;
use tpaySDK\Model\Fields\FieldTypes;

class Util
{
    /**
     * Override to set your own path to files required to include in templates.
     */
    static $libraryPath;

    /**
     * Override to set your own templates directory. You can modify the library templates copied to your custom path
     */
    static $customTemplateDirectory;

    /**
     * Parse template file
     *
     * @param string $templateFileName filename
     * @param array  $data
     *
     * @return string
     */
    public static function parseTemplate($templateFileName, $data = [])
    {
        if (is_null(static::$libraryPath)) {
            $data['static_files_url'] = $_SERVER['REQUEST_URI'].'/../../../';
        } else {
            $data['static_files_url'] = static::$libraryPath;
        }
        if (is_null(static::$customTemplateDirectory)) {
            $templateDirectory = dirname(__FILE__).'/../View/Templates/';
        } else {
            $templateDirectory = static::$customTemplateDirectory;
        }
        $buffer = false;
        if (ob_get_length() > 0) {
            $buffer = ob_get_contents();
            ob_clean();
        }
        ob_start();
        if (!file_exists($templateDirectory.$templateFileName.'.phtml')) {
            return '';
        }
        include_once $templateDirectory.$templateFileName.'.phtml';
        $parsedHTML = ob_get_contents();
        ob_clean();
        if (false !== $buffer) {
            ob_start();
            echo $buffer;
        }

        return $parsedHTML;
    }

    /**
     * Get casted value by cast type.
     *
     * @param string $value
     * @param string $type  variable type
     *
     * @throws TpayException
     */
    public static function cast($value, $type)
    {
        if (FieldTypes::INT === $type) {
            $value = (int)$value;
        } elseif (FieldTypes::NUMBER === $type) {
            $value = (float)$value;
        } elseif (FieldTypes::STRING === $type) {
            $value = (string)$value;
        } elseif (FieldTypes::BOOL === $type) {
            $value = (bool)$value;
        } else {
            throw new TpayException(sprintf('Undefined variable type %s', $type));
        }

        return $value;
    }

    public static function numberFormat($number, $decimals = 2)
    {
        return number_format($number, $decimals, '.', '');
    }

    public static function setLanguage($language)
    {
        Lang::setLang($language);
    }
}
