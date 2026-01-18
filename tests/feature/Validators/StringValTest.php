<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard stringVal template validation', catchAll(
    fn() => v::stringVal()->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[]` must be a string value')
        ->and($fullMessage)->toBe('- `[]` must be a string value')
        ->and($messages)->toBe(['stringVal' => '`[]` must be a string value']),
));

test('Standard stringVal template validation (inverted)', catchAll(
    fn() => v::not(v::stringVal())->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must not be a string value')
        ->and($fullMessage)->toBe('- `true` must not be a string value')
        ->and($messages)->toBe(['notStringVal' => '`true` must not be a string value']),
));
