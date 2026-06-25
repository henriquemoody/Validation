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
 * Object with a property typed as @var stdClass (unqualified, no leading backslash).
 *
 * Within a namespace, resolveClassName() first tries the namespace-qualified
 * FQN (`Respect\Validation\Test\Stubs\stdClass`), which does not exist, then
 * falls back to returning the plain name (`stdClass`), which is a global
 * builtin and does exist. Exercises the `return $name;` fallback branch.
 */
final class WithGlobalClassProperty
{
    /**
     * @var stdClass
     * @phpstan-var array
     */
    public array $value;
}
