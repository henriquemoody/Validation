<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ReflectionProperty;
use Respect\Validation\Validatable;

use function is_object;
use function property_exists;

final class Property extends AbstractRelated
{
    public function __construct(string $name, ?Validatable $rule = null, bool $mandatory = true)
    {
        parent::__construct($name, $rule, $mandatory);
    }

    public function getReferenceValue(mixed $input): mixed
    {
        $propertyMirror = new ReflectionProperty($input, (string) $this->getReference());
        if ($propertyMirror->isInitialized($input) === false) {
            return null;
        }

        return $propertyMirror->getValue($input);
    }

    public function hasReference(mixed $input): bool
    {
        return is_object($input) && property_exists($input, (string) $this->getReference());
    }
}