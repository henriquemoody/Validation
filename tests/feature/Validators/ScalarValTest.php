<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard scalarVal template validation', catchAll(
    fn() => v::scalarVal()->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[]` must be a scalar value')
        ->and($fullMessage)->toBe('- `[]` must be a scalar value')
        ->and($messages)->toBe(['scalarVal' => '`[]` must be a scalar value']),
));

test('Standard scalarVal template validation (inverted)', catchAll(
    fn() => v::not(v::scalarVal())->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must not be a scalar value')
        ->and($fullMessage)->toBe('- `true` must not be a scalar value')
        ->and($messages)->toBe(['notScalarVal' => '`true` must not be a scalar value']),
));
