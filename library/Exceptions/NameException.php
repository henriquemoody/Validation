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

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NameException extends ValidationException
{
    public const WITH_LOCALE = 'with_locale';

    /**
     * {@inheritdoc}
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid name',
            self::WITH_LOCALE => '{{name}} must be a valid {{locale}} name',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid name',
            self::WITH_LOCALE => '{{name}} must not be a valid {{locale}} name',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function chooseTemplate(): string
    {
        if ($this->getParam('locale')) {
            return static::WITH_LOCALE;
        }

        return parent::chooseTemplate();
    }
}
