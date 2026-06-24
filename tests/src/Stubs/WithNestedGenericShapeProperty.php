<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a nested generic+shape property: @var array<string, array{name: int}>.
 */
final class WithNestedGenericShapeProperty
{
    /** @var array<string, array{name: int}> */
    public array $items;
}
