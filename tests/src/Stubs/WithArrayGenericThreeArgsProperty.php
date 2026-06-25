<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array property typed as @var array<string, int, bool>.
 *
 * Three generic arguments are not supported, so resolveArrayGeneric() returns
 * an empty array.
 */
final class WithArrayGenericThreeArgsProperty
{
    /** @var array<string, int, bool> */
    public array $items;
}
