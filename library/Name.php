<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use function uniqid;

final readonly class Name
{
    public function __construct(
        public string $value,
    ) {
    }
}
