<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard containsAny template validation', catchAll(
    fn() => v::containsAny(['foo', 'bar'])->assert('baz'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"baz" must contain at least one value from `["foo", "bar"]`')
        ->and($fullMessage)->toBe('- "baz" must contain at least one value from `["foo", "bar"]`')
        ->and($messages)->toBe(['containsAny' => '"baz" must contain at least one value from `["foo", "bar"]`']),
));

test('Standard containsAny template validation (inverted)', catchAll(
    fn() => v::not(v::containsAny(['foo', 'bar']))->assert('fool'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"fool" must not contain any value from `["foo", "bar"]`')
        ->and($fullMessage)->toBe('- "fool" must not contain any value from `["foo", "bar"]`')
        ->and($messages)->toBe(['notContainsAny' => '"fool" must not contain any value from `["foo", "bar"]`']),
));

test('Extra containsAny template validation with strict comparison', catchAll(
    fn() => v::containsAny(['foo', 'bar'], true)->assert(['baz']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`["baz"]` must contain at least one value from `["foo", "bar"]`')
        ->and($fullMessage)->toBe('- `["baz"]` must contain at least one value from `["foo", "bar"]`')
        ->and($messages)->toBe(['containsAny' => '`["baz"]` must contain at least one value from `["foo", "bar"]`']),
));

test('Extra containsAny template validation with strict comparison (inverted)', catchAll(
    fn() => v::not(v::containsAny(['foo', 'bar'], true))->assert(['bar', 'foo']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`["bar", "foo"]` must not contain any value from `["foo", "bar"]`')
        ->and($fullMessage)->toBe('- `["bar", "foo"]` must not contain any value from `["foo", "bar"]`')
        ->and($messages)->toBe(['notContainsAny' => '`["bar", "foo"]` must not contain any value from `["foo", "bar"]`']),
));
