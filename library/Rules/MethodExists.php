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

use function is_object;
use function is_string;
use function method_exists;

/**
 * Validates whether a method from a given class exists or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MethodExists extends AbstractRule
{
    /**
     * @var string
     */
    private $methodName;

    public function __construct(string $methodName)
    {
        $this->methodName = $methodName;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input) && !is_object($input)) {
            return false;
        }

        return method_exists($input, $this->methodName);
    }
}
