<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard objectType template validation', catchAll(
    fn() => v::objectType()->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[]` must be an object')
        ->and($fullMessage)->toBe('- `[]` must be an object')
        ->and($messages)->toBe(['objectType' => '`[]` must be an object']),
));

test('Standard objectType template validation (inverted)', catchAll(
    fn() => v::not(v::objectType())->assert(new stdClass()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`stdClass {}` must not be an object')
        ->and($fullMessage)->toBe('- `stdClass {}` must not be an object')
        ->and($messages)->toBe(['notObjectType' => '`stdClass {}` must not be an object']),
));
