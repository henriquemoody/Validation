<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard finite template validation', catchAll(
    fn() => v::finite()->assert([12]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[12]` must be a finite number')
        ->and($fullMessage)->toBe('- `[12]` must be a finite number')
        ->and($messages)->toBe(['finite' => '`[12]` must be a finite number']),
));

test('Standard finite template validation (inverted)', catchAll(
    fn() => v::not(v::finite())->assert('123456'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"123456" must not be a finite number')
        ->and($fullMessage)->toBe('- "123456" must not be a finite number')
        ->and($messages)->toBe(['notFinite' => '"123456" must not be a finite number']),
));
