<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array property typed as @var list<UnknownClass>.
 *
 * The inner type of the list cannot be resolved, so the resolver returns an
 * empty array (the list branch with empty inner).
 */
final class WithListUnresolvableInnerProperty
{
    /** @var list<UnknownClass> */
    public array $items;
}
