<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an untyped property carrying a @var string docblock.
 *
 * The property has no native type declaration, so ReflectionProperty::getType()
 * returns null. The array-type guard in DocblockPropertyResolver::resolve() must
 * short-circuit and return [].
 */
final class WithUntypedVarProperty
{
    public string $value;
}
