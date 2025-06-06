<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function floor;
use function is_numeric;
use function sqrt;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a perfect square number',
    '{{name}} must not be a perfect square number',
)]
final class PerfectSquare extends Simple
{
    public function isValid(mixed $input): bool
    {
        return is_numeric($input) && floor(sqrt((float) $input)) == sqrt((float) $input);
    }
}
