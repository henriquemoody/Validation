<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard floatType template validation', catchAll(
    fn() => v::floatType()->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must be float')
        ->and($fullMessage)->toBe('- `true` must be float')
        ->and($messages)->toBe(['floatType' => '`true` must be float']),
));

test('Standard floatType template validation (inverted)', catchAll(
    fn() => v::not(v::floatType())->assert(2.0),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('2.0 must not be float')
        ->and($fullMessage)->toBe('- 2.0 must not be float')
        ->and($messages)->toBe(['notFloatType' => '2.0 must not be float']),
));
