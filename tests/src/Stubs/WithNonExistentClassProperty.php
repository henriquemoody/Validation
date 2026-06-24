<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a property typed as @var NonExistentClass.
 *
 * The identifier is not a known scalar and does not resolve to a class, so
 * resolveClassIdentifier() returns an empty array.
 */
final class WithNonExistentClassProperty
{
    /** @var NonExistentClass */
    public mixed $value;
}