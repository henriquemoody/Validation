<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array shape property typed with positional (auto-indexed) items:
 * `array{string, int}`.
 *
 * Positional items have a null keyName, so extractKeyName() returns null and
 * the items are skipped; the resulting validator list is empty.
 */
final class WithShapePositionalItemsProperty
{
    /** @var array{string, int} */
    public array $pair;
}
