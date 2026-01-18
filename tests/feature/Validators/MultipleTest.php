<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard multiple template validation', catchAll(
    fn() => v::multiple(2)->assert(5),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('5 must be a multiple of 2')
        ->and($fullMessage)->toBe('- 5 must be a multiple of 2')
        ->and($messages)->toBe(['multiple' => '5 must be a multiple of 2']),
));

test('Standard multiple template validation (inverted)', catchAll(
    fn() => v::not(v::multiple(5))->assert(25),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('25 must not be a multiple of 5')
        ->and($fullMessage)->toBe('- 25 must not be a multiple of 5')
        ->and($messages)->toBe(['notMultiple' => '25 must not be a multiple of 5']),
));

test('Extra multiple template validation with parameter', catchAll(
    fn() => v::multiple(3)->assert(22),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('22 must be a multiple of 3')
        ->and($fullMessage)->toBe('- 22 must be a multiple of 3')
        ->and($messages)->toBe(['multiple' => '22 must be a multiple of 3']),
));

test('Extra multiple template validation with parameter (inverted)', catchAll(
    fn() => v::not(v::multiple(3))->assert(9),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('9 must not be a multiple of 3')
        ->and($fullMessage)->toBe('- 9 must not be a multiple of 3')
        ->and($messages)->toBe(['notMultiple' => '9 must not be a multiple of 3']),
));
