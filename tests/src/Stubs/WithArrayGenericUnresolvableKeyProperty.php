<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array property typed as @var array<UnknownClass, string>.
 *
 * Two-arg array generic where the value validators resolve but the key
 * validators cannot, so resolveArrayGeneric() returns only an Each validator
 * (no EachKey).
 */
final class WithArrayGenericUnresolvableKeyProperty
{
    /** @var array<UnknownClass, string> */
    public array $items;
}