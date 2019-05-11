<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Message\Templates;

/**
 * Exception class for BoolType rule.
 *
 * @author Devin Torres <devin@devintorres.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BoolTypeException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        Templates::REGULAR => [
            self::STANDARD => '{{name}} must be of type boolean',
        ],
        Templates::NEGATIVE => [
            self::STANDARD => '{{name}} must not be of type boolean',
        ],
    ];
}
