<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard fibonacci template validation', catchAll(
    fn() => v::fibonacci()->assert(16),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('16 must be a valid Fibonacci number')
        ->and($fullMessage)->toBe('- 16 must be a valid Fibonacci number')
        ->and($messages)->toBe(['fibonacci' => '16 must be a valid Fibonacci number']),
));

test('Standard fibonacci template validation (inverted)', catchAll(
    fn() => v::not(v::fibonacci())->assert(21),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('21 must not be a valid Fibonacci number')
        ->and($fullMessage)->toBe('- 21 must not be a valid Fibonacci number')
        ->and($messages)->toBe(['notFibonacci' => '21 must not be a valid Fibonacci number']),
));
