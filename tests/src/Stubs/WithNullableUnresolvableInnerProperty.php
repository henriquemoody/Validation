<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a nullable property typed as @var ?UnknownClass.
 *
 * The inner type cannot be resolved, so the resolver must return an empty array
 * (NullableTypeNode branch with empty inner).
 */
final class WithNullableUnresolvableInnerProperty
{
    /** @var ?UnknownClass */
    public mixed $value;
}