<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard json template validation', catchAll(
    fn() => v::json()->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`false` must be a valid JSON string')
        ->and($fullMessage)->toBe('- `false` must be a valid JSON string')
        ->and($messages)->toBe(['json' => '`false` must be a valid JSON string']),
));

test('Standard json template validation (inverted)', catchAll(
    fn() => v::not(v::json())->assert('{"foo": "bar", "number":1}'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"{\\"foo\\": \\"bar\\", \\"number\\":1}" must not be a valid JSON string')
        ->and($fullMessage)->toBe('- "{\\"foo\\": \\"bar\\", \\"number\\":1}" must not be a valid JSON string')
        ->and($messages)->toBe(['notJson' => '"{\\"foo\\": \\"bar\\", \\"number\\":1}" must not be a valid JSON string']),
));
