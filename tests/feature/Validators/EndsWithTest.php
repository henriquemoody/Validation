<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard endsWith template validation', catchAll(
    fn() => v::endsWith('foo')->assert('bar'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bar" must end with "foo"')
        ->and($fullMessage)->toBe('- "bar" must end with "foo"')
        ->and($messages)->toBe(['endsWith' => '"bar" must end with "foo"']),
));

test('Standard endsWith template validation (inverted)', catchAll(
    fn() => v::not(v::endsWith('foo'))->assert(['bar', 'foo']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`["bar", "foo"]` must not end with "foo"')
        ->and($fullMessage)->toBe('- `["bar", "foo"]` must not end with "foo"')
        ->and($messages)->toBe(['notEndsWith' => '`["bar", "foo"]` must not end with "foo"']),
));
