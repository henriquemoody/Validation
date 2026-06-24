<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array shape property typed with integer keys:
 * `array{0: string, 1: int}`.
 *
 * Exercises the ConstExprIntegerNode branch of DocblockPropertyResolver::extractKeyName().
 */
final class WithShapeIntKeyProperty
{
    /** @var array{0: string, 1: int} */
    public array $pair;
}