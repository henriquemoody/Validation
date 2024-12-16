<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

final class Failures
{
    /** @param array<string, mixed> $messages */
    public function __construct(
        public readonly Result $result,
        public readonly string $message,
        public readonly string $fullMessage,
        public readonly array $messages,
    ) {
    }
}
