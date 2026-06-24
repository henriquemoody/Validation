<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a nullable string property typed as @var ?string.
 *
 * Exercises the NullableTypeNode branch of DocblockPropertyResolver::resolveTypeNode().
 */
final class WithNullableStringProperty
{
    /** @var ?string */
    public mixed $name;
}