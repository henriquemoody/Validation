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
 * Exceptions thrown by Uploaded rule.
 *
 * @author Fajar Khairil <fajar.khairil@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class UploadedException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        Templates::REGULAR => [
            self::STANDARD => '{{name}} must be an uploaded file',
        ],
        Templates::NEGATIVE => [
            self::STANDARD => '{{name}} must not be an uploaded file',
        ],
    ];
}
