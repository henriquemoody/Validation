<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function function_exists;
use function is_string;

/**
 * Validates whether a function exists or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FunctionExists extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return function_exists($input);
    }
}
