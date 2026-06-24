<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array shape property with an optional key: @var array{name: string, age?: int}.
 */
final class WithShapeOptionalKeyProperty
{
    /** @var array{name: string, age?: int} */
    public array $person;
}
