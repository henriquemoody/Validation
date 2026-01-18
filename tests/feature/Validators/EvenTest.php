<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard even template validation', catchAll(
    fn() => v::even()->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must be an even number')
        ->and($fullMessage)->toBe('- -1 must be an even number')
        ->and($messages)->toBe(['even' => '-1 must be an even number']),
));

test('Standard even template validation (inverted)', catchAll(
    fn() => v::not(v::even())->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('2 must be an odd number')
        ->and($fullMessage)->toBe('- 2 must be an odd number')
        ->and($messages)->toBe(['notEven' => '2 must be an odd number']),
));
