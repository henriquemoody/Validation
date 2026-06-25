<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a string-typed property carrying a @var string docblock.
 *
 * The native type is `string` (builtin, non-array), so the array-type guard
 * in DocblockPropertyResolver::resolve() must short-circuit and return [].
 */
final class WithStringVarProperty
{
    public string $name;
}
