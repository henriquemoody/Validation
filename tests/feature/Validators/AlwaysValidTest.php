<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard alwaysValid template validation (inverted)', catchAll(
    fn() => v::not(v::alwaysValid())->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must be invalid')
        ->and($fullMessage)->toBe('- `true` must be invalid')
        ->and($messages)->toBe(['notAlwaysValid' => '`true` must be invalid']),
));
