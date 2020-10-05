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

use ReflectionClass;

use function is_string;

/**
 * Validates whether a constant from a given class exists or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ConstantExists extends AbstractRule
{
    /**
     * @var ReflectionClass
     */
    private $reflection;

    /**
     * @param class-string|object $class
     */
    public function __construct($class)
    {
        $this->reflection = new ReflectionClass($class);
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return $this->reflection->getConstant($input) !== false;
    }
}
