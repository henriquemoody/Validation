<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard iterableVal template validation', catchAll(
    fn() => v::iterableVal()->assert(3),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('3 must be an iterable value')
        ->and($fullMessage)->toBe('- 3 must be an iterable value')
        ->and($messages)->toBe(['iterableVal' => '3 must be an iterable value']),
));

test('Standard iterableVal template validation (inverted)', catchAll(
    fn() => v::not(v::iterableVal())->assert([2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[2, 3]` must not be an iterable value')
        ->and($fullMessage)->toBe('- `[2, 3]` must not be an iterable value')
        ->and($messages)->toBe(['notIterableVal' => '`[2, 3]` must not be an iterable value']),
));
