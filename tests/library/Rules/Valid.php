<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules;

use Respect\Validation\Rules\Core\Simple;

final class Valid extends Simple
{
    public function isValid(mixed $input): bool
    {
        return true;
    }
}
