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

namespace Respect\Validation;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;

/**
 * Interface for the factory that creates rules and exceptions.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
interface Factory
{
    /**
     * Creates a rule.
     *
     * @param mixed[] $arguments
     *
     * @throws ComponentException When rule cannot be created.
     */
    public function rule(string $ruleName, array $arguments = []): Validatable;

    /**
     * Creates an exception.
     *
     * @param mixed $input
     * @param mixed[] $extraParams
     *
     * @throws ComponentException When exception cannot be created.
     */
    public function exception(Validatable $validatable, $input, array $extraParams = []): ValidationException;
}
