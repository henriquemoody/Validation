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

use function extension_loaded;
use function is_string;

/**
 * Validates whether an extension is loaded.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ExtensionLoaded extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return extension_loaded($input);
    }
}
