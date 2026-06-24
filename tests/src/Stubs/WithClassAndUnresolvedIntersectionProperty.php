<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a property typed as @var FirstRole&UnknownClass.
 *
 * Intersection where one member (FirstRole) is resolvable and the other is
 * not: resolveIntersectionType() skips the unresolved member and returns the
 * resolved validators.
 */
final class WithClassAndUnresolvedIntersectionProperty
{
    /** @var FirstRole&UnknownClass */
    public mixed $value;
}