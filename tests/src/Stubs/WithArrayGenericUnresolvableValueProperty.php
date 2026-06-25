<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array property typed as @var array<string, UnknownClass>.
 *
 * Two-arg array generic where the value validators cannot be resolved, so
 * resolveArrayGeneric() returns an empty array.
 */
final class WithArrayGenericUnresolvableValueProperty
{
    /** @var array<string, UnknownClass> */
    public array $items;
}
