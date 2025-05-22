<?php

require __DIR__ . '/vendor/tpay-com/coding-standards/bootstrap.php';

/**
 * @var \Tpay\CodingStandards\PhpCsFixerConfig
 */
$config = Tpay\CodingStandards\PhpCsFixerConfigFactory::createWithLegacyRules();
$rules = $config->getRules();
//PHP 7.0 compatibility
$rules['nullable_type_declaration'] = 'union';
$config->setRules($rules);
$config->setFinder(
    PhpCsFixer\Finder::create()
        ->ignoreDotFiles(false)
        ->in(__DIR__ . '/..')
);

return $config;