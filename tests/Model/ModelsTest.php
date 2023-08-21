<?php

namespace Tpay\OpenApi\Tests\Model;

use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class ModelsTest extends TestCase
{
    /**
     * @coversNothing
     *
     * @dataProvider dataModel
     */
    public function testModel($class)
    {
        self::assertTrue(class_exists($class) || interface_exists($class));

        if (class_exists($class)) {
            new $class();
        }
    }

    public static function dataModel()
    {
        $modelDirectory = realpath(__DIR__.'/../../src/Model');

        /** @var SplFileInfo $fileInfo */
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($modelDirectory)) as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }

            $className = 'Tpay\\OpenApi\\Model\\'.substr(
                $fileInfo->getRealPath(),
                strlen($modelDirectory) + 1,
                -4
            );
            $className = str_replace('/', '\\', $className);

            yield $className => [$className];
        }
    }
}
