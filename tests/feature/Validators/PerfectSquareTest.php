<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard perfectSquare template validation', catchAll(
    fn() => v::perfectSquare()->assert(250),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('250 must be a perfect square number')
        ->and($fullMessage)->toBe('- 250 must be a perfect square number')
        ->and($messages)->toBe(['perfectSquare' => '250 must be a perfect square number']),
));

test('Standard perfectSquare template validation (inverted)', catchAll(
    fn() => v::not(v::perfectSquare())->assert(9),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('9 must not be a perfect square number')
        ->and($fullMessage)->toBe('- 9 must not be a perfect square number')
        ->and($messages)->toBe(['notPerfectSquare' => '9 must not be a perfect square number']),
));
