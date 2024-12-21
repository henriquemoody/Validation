<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Placeholder;

final class Path
{
    public const SEPARATOR = '.';

    public function __construct(
        public readonly int|string $value,
        public readonly ?Path $child = null
    ) {
    }

    public function withParent(int|string $value): self
    {
        return new self($value, $this);
    }

    public function isEqual(Path $path): bool
    {
        if ($this->value !== $path->value) {
            return false;
        }

        if ($this->child === null && $path->child === null) {
            return true;
        }

        return $this->child !== null && $path->child !== null && $this->child->isEqual($path->child);
    }

    public function getDeepest(): Path
    {
        return $this->child?->getDeepest() ?? $this;
    }

    public function getFull(): string
    {
        $path = $this;
        $string = (string) $path->value;
        while ($path = $path->child) {
            $string .= self::SEPARATOR . $path->value;
        }

        return $string;
    }
}
