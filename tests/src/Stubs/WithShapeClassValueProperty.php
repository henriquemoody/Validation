<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array shape property typed as @var array{name: string, address: NestedAddress}.
 */
final class WithShapeClassValueProperty
{
    /** @var array{name: string, address: NestedAddress} */
    public array $data;
}
