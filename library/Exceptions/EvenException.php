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
 * Exceptions to be thrown by the Even Rule.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class EvenException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        Templates::REGULAR => [
            self::STANDARD => '{{name}} must be an even number',
        ],
        Templates::NEGATIVE => [
            self::STANDARD => '{{name}} must not be an even number',
        ],
    ];
}
