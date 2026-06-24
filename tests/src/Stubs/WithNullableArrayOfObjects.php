<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a nullable array of objects property.
 */
final class WithNullableArrayOfObjects
{
    /** @var array<NestedAddress>|null */
    public array|null $addresses = null;
}
