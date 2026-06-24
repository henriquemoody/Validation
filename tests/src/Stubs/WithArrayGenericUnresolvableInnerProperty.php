<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array property typed as @var array<UnknownClass>.
 *
 * Single-arg array generic whose inner type cannot be resolved, so
 * resolveArrayGeneric() returns an empty array.
 */
final class WithArrayGenericUnresolvableInnerProperty
{
    /** @var array<UnknownClass> */
    public array $items;
}