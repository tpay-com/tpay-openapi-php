<?php

namespace Tpay;

class Loader
{
    public function loadDependencies()
    {
        spl_autoload_register(function ($class) {
            $legacyPrefix = 'tpaySDK\\';
            if (0 === strncmp($legacyPrefix, $class, strlen($legacyPrefix))) {
                require_once __DIR__.'/legacy_classes.php';
                return;
            }

            $prefix = 'Tpay\\';
            if (0 === strncmp($prefix, $class, strlen($prefix))) {
                $relativeClass = substr($class, strlen($prefix));
                $file = __DIR__.'/'.str_replace('\\', '/', $relativeClass).'.php';
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        });
    }
}
