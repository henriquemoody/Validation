<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard startsWith template validation', catchAll(
    fn() => v::startsWith('b')->assert(['a', 'b']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`["a", "b"]` must start with "b"')
        ->and($fullMessage)->toBe('- `["a", "b"]` must start with "b"')
        ->and($messages)->toBe(['startsWith' => '`["a", "b"]` must start with "b"']),
));

test('Standard startsWith template validation (inverted)', catchAll(
    fn() => v::not(v::startsWith('c'))->assert(['c', 'd']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`["c", "d"]` must not start with "c"')
        ->and($fullMessage)->toBe('- `["c", "d"]` must not start with "c"')
        ->and($messages)->toBe(['notStartsWith' => '`["c", "d"]` must not start with "c"']),
));

test('Extra startsWith template validation with strict comparison', catchAll(
    fn() => v::startsWith('3.3', true)->assert([3.3, 4.4]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[3.3, 4.4]` must start with "3.3"')
        ->and($fullMessage)->toBe('- `[3.3, 4.4]` must start with "3.3"')
        ->and($messages)->toBe(['startsWith' => '`[3.3, 4.4]` must start with "3.3"']),
));

test('Extra startsWith template validation with strict comparison (inverted)', catchAll(
    fn() => v::not(v::startsWith(1.1))->assert([1.1, 2.2]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[1.1, 2.2]` must not start with 1.1')
        ->and($fullMessage)->toBe('- `[1.1, 2.2]` must not start with 1.1')
        ->and($messages)->toBe(['notStartsWith' => '`[1.1, 2.2]` must not start with 1.1']),
));
