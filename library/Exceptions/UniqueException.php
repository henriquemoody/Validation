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
 * Exceptions thrown by Unique rule.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Krzysztof Śmiałek <admin@avensome.net>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class UniqueException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        Templates::REGULAR => [
            self::STANDARD => '{{name}} must not contain duplicates',
        ],
        Templates::NEGATIVE => [
            self::STANDARD => '{{name}} must contain duplicates',
        ],
    ];
}
