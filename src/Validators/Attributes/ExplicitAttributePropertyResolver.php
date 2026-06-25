<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Attributes;

use ReflectionAttribute;
use ReflectionProperty;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Attributes;

final class ExplicitAttributePropertyResolver implements PropertyResolver
{
    /** @return array<Validator> */
    public function resolve(ReflectionProperty $property, Attributes $attributes): array
    {
        $validators = [];
        foreach ($property->getAttributes(Validator::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
            $propertyValidator = $attribute->getName() === Attributes::class ? $attributes : $attribute->newInstance();
            $validators[] = $propertyValidator;
        }

        return $validators;
    }
}
