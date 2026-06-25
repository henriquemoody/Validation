<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a property typed as @var string|null.
 *
 * Union of a resolvable identifier and `null`: resolveUnionType() returns a
 * single NullOr validator.
 */
final class WithNullableUnionStringProperty
{
    /**
     * @var string|null
     * @phpstan-var array
     */
    public array $name;
}
