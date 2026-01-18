<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard callableType template validation', catchAll(
    fn() => v::callableType()->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must be a callable')
        ->and($fullMessage)->toBe('- `true` must be a callable')
        ->and($messages)->toBe(['callableType' => '`true` must be a callable']),
));

test('Standard callableType template validation (inverted)', catchAll(
    fn() => v::not(v::callableType())->assert(function (): void {
        // Do nothing
    }),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`Closure {}` must not be a callable')
        ->and($fullMessage)->toBe('- `Closure {}` must not be a callable')
        ->and($messages)->toBe(['notCallableType' => '`Closure {}` must not be a callable']),
));
