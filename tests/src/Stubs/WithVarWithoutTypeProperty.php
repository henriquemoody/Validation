<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a property whose docblock has a `@var` tag without a type.
 *
 * The lexer/parser produce an empty var-tag list, so parseVarType() returns null
 * and the resolver returns an empty array.
 */
final class WithVarWithoutTypeProperty
{
    /** @var */
    public mixed $value;
}
