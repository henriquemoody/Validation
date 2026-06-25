<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array property typed as @var string[] (legacy short array syntax).
 *
 * Exercises the ArrayTypeNode branch of DocblockPropertyResolver::resolveTypeNode().
 */
final class WithShortArrayStringProperty
{
    /** @var string[] */
    public array $names;
}
