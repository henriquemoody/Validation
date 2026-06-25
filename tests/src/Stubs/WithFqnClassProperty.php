<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use stdClass;

/**
 * Object with a property typed as @var \stdClass.
 *
 * The leading backslash makes resolveClassName() return the name directly via
 * ltrim() (the `str_starts_with($name, '\\')` branch).
 */
final class WithFqnClassProperty
{
    /**
     * @var stdClass
     * @phpstan-var array
     */
    public array $value;
}
