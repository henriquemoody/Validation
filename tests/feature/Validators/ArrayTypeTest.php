<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard arrayType template validation', catchAll(
    fn() => v::arrayType()->assert('teste'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"teste" must be an array')
        ->and($fullMessage)->toBe('- "teste" must be an array')
        ->and($messages)->toBe(['arrayType' => '"teste" must be an array']),
));

test('Standard arrayType template validation (inverted)', catchAll(
    fn() => v::not(v::arrayType())->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[]` must not be an array')
        ->and($fullMessage)->toBe('- `[]` must not be an array')
        ->and($messages)->toBe(['notArrayType' => '`[]` must not be an array']),
));
