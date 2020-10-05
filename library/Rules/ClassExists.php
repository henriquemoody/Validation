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

use function class_exists;
use function is_string;

/**
 * Validates whether a class exists or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ClassExists extends AbstractRule
{
    /**
     * @var bool
     */
    private $autoload;

    public function __construct(bool $autoload = true)
    {
        $this->autoload = $autoload;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return class_exists($input, $this->autoload);
    }
}
