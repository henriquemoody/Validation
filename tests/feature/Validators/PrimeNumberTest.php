<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard primeNumber template validation', catchAll(
    fn() => v::primeNumber()->assert(10),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('10 must be a prime number')
        ->and($fullMessage)->toBe('- 10 must be a prime number')
        ->and($messages)->toBe(['primeNumber' => '10 must be a prime number']),
));

test('Standard primeNumber template validation (inverted)', catchAll(
    fn() => v::not(v::primeNumber())->assert(3),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('3 must not be a prime number')
        ->and($fullMessage)->toBe('- 3 must not be a prime number')
        ->and($messages)->toBe(['notPrimeNumber' => '3 must not be a prime number']),
));
