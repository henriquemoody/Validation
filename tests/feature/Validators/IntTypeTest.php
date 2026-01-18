<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard intType template validation', catchAll(
    fn() => v::intType()->assert(new stdClass()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`stdClass {}` must be an integer')
        ->and($fullMessage)->toBe('- `stdClass {}` must be an integer')
        ->and($messages)->toBe(['intType' => '`stdClass {}` must be an integer']),
));

test('Standard intType template validation (inverted)', catchAll(
    fn() => v::not(v::intType())->assert(42),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('42 must not be an integer')
        ->and($fullMessage)->toBe('- 42 must not be an integer')
        ->and($messages)->toBe(['notIntType' => '42 must not be an integer']),
));
