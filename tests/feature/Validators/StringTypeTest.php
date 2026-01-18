<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('StringType default template with numeric input', catchAll(
    fn() => v::stringType()->assert(42),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('42 must be a string')
        ->and($fullMessage)->toBe('- 42 must be a string')
        ->and($messages)->toBe(['stringType' => '42 must be a string']),
));

test('StringType default template with negative assertion', catchAll(
    fn() => v::not(v::stringType())->assert('foo'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"foo" must not be a string')
        ->and($fullMessage)->toBe('- "foo" must not be a string')
        ->and($messages)->toBe(['notStringType' => '"foo" must not be a string']),
));

test('StringType default template with boolean input', catchAll(
    fn() => v::stringType()->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must be a string')
        ->and($fullMessage)->toBe('- `true` must be a string')
        ->and($messages)->toBe(['stringType' => '`true` must be a string']),
));
