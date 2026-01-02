<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/tests/feature',
    ])
    ->withPhpSets()
    ->withPreparedSets(
        deadCode: false,
        codeQuality: false,
    )
    ->withRules([
        \Utils\Rector\SetNameToNamedRector::class,
        \Utils\Rector\SetTemplateToTemplatedRector::class,
        \Utils\Rector\SwapNamedArgumentsRector::class,
        \Utils\Rector\SwapTemplatedArgumentsRector::class,
    ]);

