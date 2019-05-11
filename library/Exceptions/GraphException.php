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
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class GraphException extends FilteredValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        Templates::REGULAR => [
            self::STANDARD => '{{name}} must contain only graphical characters',
            self::EXTRA => '{{name}} must contain only graphical characters and {{additionalChars}}',
        ],
        Templates::NEGATIVE => [
            self::STANDARD => '{{name}} must not contain graphical characters',
            self::EXTRA => '{{name}} must not contain graphical characters or {{additionalChars}}',
        ],
    ];
}
