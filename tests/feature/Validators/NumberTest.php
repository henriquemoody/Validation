<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Number default template with NaN input', catchAll(
    fn() => v::number()->assert(acos(1.01)),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`NaN` must be a valid number')
        ->and($fullMessage)->toBe('- `NaN` must be a valid number')
        ->and($messages)->toBe(['number' => '`NaN` must be a valid number']),
));

test('Number default template with negative assertion', catchAll(
    fn() => v::not(v::number())->assert(42),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('42 must not be a number')
        ->and($fullMessage)->toBe('- 42 must not be a number')
        ->and($messages)->toBe(['notNumber' => '42 must not be a number']),
));

test('Number default template with constant NaN', catchAll(
    fn() => v::number()->assert(NAN),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`NaN` must be a valid number')
        ->and($fullMessage)->toBe('- `NaN` must be a valid number')
        ->and($messages)->toBe(['number' => '`NaN` must be a valid number']),
));
