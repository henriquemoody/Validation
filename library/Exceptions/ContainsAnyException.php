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
 * @author Kirill Dlussky <kirill@dlussky.ru>
 */
final class ContainsAnyException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        Templates::REGULAR => [
            self::STANDARD => '{{name}} must contain at least one of the values {{needles}}',
        ],
        Templates::NEGATIVE => [
            self::STANDARD => '{{name}} must not contain any of the values {{needles}}',
        ],
    ];
}
