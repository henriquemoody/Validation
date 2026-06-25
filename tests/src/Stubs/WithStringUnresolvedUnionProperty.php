<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a property typed as @var string|UnknownClass.
 *
 * Union where one member is resolvable and the other is not: resolveUnionType()
 * skips the unresolved member and returns a single-element array (the
 * `count($validators) === 1` branch without null).
 */
final class WithStringUnresolvedUnionProperty
{
    /**
     * @var string|UnknownClass
     * @phpstan-var array
     */
    public array $value;
}
