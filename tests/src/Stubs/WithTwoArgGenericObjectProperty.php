<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array property typed as @var array<string, NestedAddress>.
 */
final class WithTwoArgGenericObjectProperty
{
    /** @var array<string, NestedAddress> */
    public array $addresses;
}
