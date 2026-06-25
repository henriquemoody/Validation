<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a property typed as @var int|float.
 *
 * Union of two resolvable scalar identifiers with no `null`: resolveUnionType()
 * returns an AnyOf validator with both branches.
 */
final class WithIntFloatUnionProperty
{
    /**
     * @var int|float
     * @phpstan-var array
     */
    public array $value;
}
