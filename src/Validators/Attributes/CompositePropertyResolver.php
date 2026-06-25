<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Attributes;

use ReflectionProperty;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Attributes;

use function array_values;
use function in_array;

final class CompositePropertyResolver implements PropertyResolver
{
    /** @var list<PropertyResolver> */
    private readonly array $resolvers;

    public function __construct(PropertyResolver ...$resolvers)
    {
        $this->resolvers = array_values($resolvers);
    }

    /** @return array<Validator> */
    public function resolve(ReflectionProperty $property, Attributes $attributes): array
    {
        $accumulated = [];

        foreach ($this->resolvers as $resolver) {
            $validators = $resolver->resolve($property, $attributes);

            if ($validators === []) {
                continue;
            }

            $accumulated = [...$accumulated, ...$validators];

            if (in_array($attributes, $validators, true)) {
                return $accumulated;
            }
        }

        return $accumulated;
    }
}
