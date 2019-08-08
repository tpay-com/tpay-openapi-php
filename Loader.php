<?php
namespace tpaySDK;

class Loader
{
    public function loadDependencies()
    {
        spl_autoload_register(function ($class) {
            // project-specific namespace prefix
            $prefix = 'tpaySDK';
            // base directory for the namespace prefix
            $baseDir = __DIR__.'/';
            // does the class use the namespace prefix?
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                // no, move to the next registered autoloader
                return;
            }
            // get the relative class name
            $relativeClass = substr($class, $len);
            // replace the namespace prefix with the base directory, replace namespace
            // separators with directory separators in the relative class name, append
            // with .php
            $file = $baseDir.str_replace('\\', '/', $relativeClass).'.php';
            // if the file exists, require it
            if (file_exists($file)) {
                require_once $file;
            }
        });
    }

}
