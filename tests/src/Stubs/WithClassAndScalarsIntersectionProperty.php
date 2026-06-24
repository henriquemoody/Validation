<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a property typed as @var FirstRole&string&float&bool.
 *
 * Intersection mixing a resolvable class identifier with scalar identifiers
 * that are *not* class identifiers. Exercises the `isClassIdentifier` false
 * branches (string, int, float, bool) and ensures the class branch is detected
 * while the scalar branches are not mistaken for class branches.
 */
final class WithClassAndScalarsIntersectionProperty
{
    /** @var FirstRole&string&float&bool */
    public mixed $value;
}