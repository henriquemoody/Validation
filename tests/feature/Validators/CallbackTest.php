<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard callback template validation', catchAll(
    fn() => v::callback('is_string')->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must be valid')
        ->and($fullMessage)->toBe('- `true` must be valid')
        ->and($messages)->toBe(['callback' => '`true` must be valid']),
));

test('Standard callback template validation (inverted)', catchAll(
    fn() => v::not(v::callback('is_string'))->assert('foo'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"foo" must be invalid')
        ->and($fullMessage)->toBe('- "foo" must be invalid')
        ->and($messages)->toBe(['notCallback' => '"foo" must be invalid']),
));
