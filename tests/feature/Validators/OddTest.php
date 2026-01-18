<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Odd default template with even number', catchAll(
    fn() => v::odd()->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('2 must be an odd number')
        ->and($fullMessage)->toBe('- 2 must be an odd number')
        ->and($messages)->toBe(['odd' => '2 must be an odd number']),
));

test('Odd default template with negative assertion', catchAll(
    fn() => v::not(v::odd())->assert(7),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('7 must be an even number')
        ->and($fullMessage)->toBe('- 7 must be an even number')
        ->and($messages)->toBe(['notOdd' => '7 must be an even number']),
));

test('Odd default template with another even number', catchAll(
    fn() => v::odd()->assert(4),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('4 must be an odd number')
        ->and($fullMessage)->toBe('- 4 must be an odd number')
        ->and($messages)->toBe(['odd' => '4 must be an odd number']),
));
