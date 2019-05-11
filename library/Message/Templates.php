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

namespace Respect\Validation\Message;

use function current;

final class Templates
{
    public const REGULAR = 'regular';
    public const NEGATIVE = 'negative';

    /**
     * @var Template[][]
     */
    private $templates = [];

    /**
     * @param Template[] $regular
     * @param Template[] $negative
     */
    public function __construct(array $regular, array $negative)
    {
        $this->addTemplates(self::REGULAR, ...$regular);
        $this->addTemplates(self::NEGATIVE, ...$negative);
    }

    public function getDefaultTemplate(string $mode): Template
    {
        return current($this->templates[$mode]);
    }

    public function getTemplate(string $mode, string $id): ?Template
    {
        foreach ($this->templates[$mode] as $template) {
            if ($template->getId() === $id) {
                return $template;
            }
        }

        return null;
    }

    private function addTemplates(string $mode, Template ...$templates): void
    {
        $this->templates[$mode] = $templates;
    }
}
