<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a property typed as @var UnknownOne|UnknownTwo.
 *
 * Union where no member is resolvable: resolveUnionType() returns an empty
 * array.
 */
final class WithAllUnresolvedUnionProperty
{
    /** @var UnknownOne|UnknownTwo */
    public mixed $value;
}