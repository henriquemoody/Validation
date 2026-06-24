<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a list property typed as @var list<NestedAddress>.
 */
final class WithListObjectProperty
{
    /** @var list<NestedAddress> */
    public array $addresses;
}
