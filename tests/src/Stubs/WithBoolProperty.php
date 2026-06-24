<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a boolean property typed as @var bool.
 *
 * Exercises the `bool`/`boolean`/`true`/`false` identifier branch of
 * resolveIdentifier().
 */
final class WithBoolProperty
{
    /** @var bool */
    public mixed $value;
}