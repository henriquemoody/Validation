<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers\Deprecated;

use Respect\Validation\Transformers\RuleSpec;
use Respect\Validation\Transformers\Transformer;

use function current;
use function sprintf;
use function trigger_error;

use const E_USER_DEPRECATED;

final class TypeRule implements Transformer
{
    private const AVAILABLE_TYPES = [
        'array' => 'arrayType',
        'bool' => 'boolType',
        'boolean' => 'boolType',
        'callable' => 'callableType',
        'double' => 'floatType',
        'float' => 'floatType',
        'int' => 'intType',
        'integer' => 'intType',
        'null' => 'nullType',
        'object' => 'objectType',
        'resource' => 'resourceType',
        'string' => 'stringType',
    ];

    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if ($ruleSpec->name !== 'type') {
            return $this->next->transform($ruleSpec);
        }

        $type = current($ruleSpec->arguments);
        $name = self::AVAILABLE_TYPES[$type] ?? $type;

        trigger_error(
            sprintf(
                'The type() rule is deprecated and will be removed in the next major version. Use %s() instead.',
                $name
            ),
            E_USER_DEPRECATED
        );

        return new RuleSpec($name, []);
    }
}
