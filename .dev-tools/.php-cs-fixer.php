<?php

require __DIR__.'/vendor/tpay-com/coding-standards/bootstrap.php';

$config = Tpay\CodingStandards\PhpCsFixerConfigFactory::createWithLegacyRules();
$config->setFinder(
    PhpCsFixer\Finder::create()
        ->ignoreDotFiles(false)
        ->in(__DIR__.'/..')
);

return $config;
