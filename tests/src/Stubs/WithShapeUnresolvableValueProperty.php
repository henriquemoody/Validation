<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with an array shape property typed as @var array{name: UnknownClass}.
 *
 * The item value type cannot be resolved, so the item is skipped and the
 * resulting validator list is empty.
 */
final class WithShapeUnresolvableValueProperty
{
    /** @var array{name: UnknownClass} */
    public array $data;
}
