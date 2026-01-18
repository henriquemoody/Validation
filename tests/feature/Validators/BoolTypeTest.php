<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard boolType template validation', catchAll(
    fn() => v::boolType()->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[]` must be a boolean')
        ->and($fullMessage)->toBe('- `[]` must be a boolean')
        ->and($messages)->toBe(['boolType' => '`[]` must be a boolean']),
));

test('Standard boolType template validation (inverted)', catchAll(
    fn() => v::not(v::boolType())->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`false` must not be a boolean')
        ->and($fullMessage)->toBe('- `false` must not be a boolean')
        ->and($messages)->toBe(['notBoolType' => '`false` must not be a boolean']),
));
