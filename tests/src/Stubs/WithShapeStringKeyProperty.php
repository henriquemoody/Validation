<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array shape property typed with a quoted string key:
 * `array{'first-name': string, 'age': int}`.
 *
 * Exercises the ConstExprStringNode branch of DocblockPropertyResolver::extractKeyName().
 */
final class WithShapeStringKeyProperty
{
    /** @var array{'first-name': string, 'age': int} */
    public array $person;
}