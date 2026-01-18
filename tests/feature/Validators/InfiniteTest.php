<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard infinite template validation', catchAll(
    fn() => v::infinite()->assert(-9),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-9 must be an infinite number')
        ->and($fullMessage)->toBe('- -9 must be an infinite number')
        ->and($messages)->toBe(['infinite' => '-9 must be an infinite number']),
));

test('Standard infinite template validation (inverted)', catchAll(
    fn() => v::not(v::infinite())->assert(INF),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`INF` must not be an infinite number')
        ->and($fullMessage)->toBe('- `INF` must not be an infinite number')
        ->and($messages)->toBe(['notInfinite' => '`INF` must not be an infinite number']),
));
