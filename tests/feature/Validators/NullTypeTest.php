<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('NullType default template with empty string', catchAll(
    fn() => v::nullType()->assert(''),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"" must be null')
        ->and($fullMessage)->toBe('- "" must be null')
        ->and($messages)->toBe(['nullType' => '"" must be null']),
));

test('NullType default template with negative assertion', catchAll(
    fn() => v::not(v::nullType())->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must not be null')
        ->and($fullMessage)->toBe('- `null` must not be null')
        ->and($messages)->toBe(['notNullType' => '`null` must not be null']),
));

test('NullType default template with boolean false', catchAll(
    fn() => v::nullType()->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`false` must be null')
        ->and($fullMessage)->toBe('- `false` must be null')
        ->and($messages)->toBe(['nullType' => '`false` must be null']),
));
