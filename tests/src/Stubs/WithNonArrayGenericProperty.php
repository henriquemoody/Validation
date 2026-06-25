<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a property typed as @var Collection<string>.
 *
 * The generic base is neither `array`/`non-empty-array` nor `list`/`non-empty-list`,
 * so resolveGenericType() returns an empty array.
 */
final class WithNonArrayGenericProperty
{
    /** @var Collection<string> */
    public mixed $items;
}
