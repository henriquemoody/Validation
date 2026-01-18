<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Contains count times template validation', catchAll(
    fn() => v::containsCount('foo', 2)->assert('bar'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bar" must contain "foo" 2 time(s)')
        ->and($fullMessage)->toBe('- "bar" must contain "foo" 2 time(s)')
        ->and($messages)->toBe(['containsCount' => '"bar" must contain "foo" 2 time(s)']),
));

test('Contains count times template validation (inverted)', catchAll(
    fn() => v::not(v::containsCount('bar', 2))->assert('bar baz bar'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bar baz bar" must not contain "bar" 2 time(s)')
        ->and($fullMessage)->toBe('- "bar baz bar" must not contain "bar" 2 time(s)')
        ->and($messages)->toBe(['notContainsCount' => '"bar baz bar" must not contain "bar" 2 time(s)']),
));

test('Contains count once template validation', catchAll(
    fn() => v::containsCount('foo', 1, true)->assert(['foo', 'foo']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`["foo", "foo"]` must contain "foo" only once')
        ->and($fullMessage)->toBe('- `["foo", "foo"]` must contain "foo" only once')
        ->and($messages)->toBe(['containsCount' => '`["foo", "foo"]` must contain "foo" only once']),
));

test('Contains count once template validation (inverted)', catchAll(
    fn() => v::not(v::containsCount('foo', 1, true))->assert(['foo', 'bar']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`["foo", "bar"]` must not contain "foo" only once')
        ->and($fullMessage)->toBe('- `["foo", "bar"]` must not contain "foo" only once')
        ->and($messages)->toBe(['notContainsCount' => '`["foo", "bar"]` must not contain "foo" only once']),
));
