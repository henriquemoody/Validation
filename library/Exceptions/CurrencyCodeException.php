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
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Justin Hook <justinhook88@yahoo.co.uk>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CurrencyCodeException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        Templates::REGULAR => [
            self::STANDARD => '{{name}} must be a valid currency',
        ],
        Templates::NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid currency',
        ],
    ];
}
