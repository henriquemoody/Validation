<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard graph template validation', catchAll(
    fn() => v::graph()->assert("foo\nbar"),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"foo\nbar" must contain only graphical characters')
        ->and($fullMessage)->toBe('- "foo\nbar" must contain only graphical characters')
        ->and($messages)->toBe(['graph' => '"foo\nbar" must contain only graphical characters']),
));

test('Standard graph template validation (inverted)', catchAll(
    fn() => v::not(v::graph())->assert('abc123'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abc123" must not contain graphical characters')
        ->and($fullMessage)->toBe('- "abc123" must not contain graphical characters')
        ->and($messages)->toBe(['notGraph' => '"abc123" must not contain graphical characters']),
));

test('Extra graph template validation with additional characters', catchAll(
    fn() => v::graph('foo')->assert("foo\nbar"),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"foo\nbar" must contain only graphical characters and "foo"')
        ->and($fullMessage)->toBe('- "foo\nbar" must contain only graphical characters and "foo"')
        ->and($messages)->toBe(['graph' => '"foo\nbar" must contain only graphical characters and "foo"']),
));

test('Extra graph template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::graph("\n"))->assert("foo\nbar"),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"foo\nbar" must not contain graphical characters or "\n"')
        ->and($fullMessage)->toBe('- "foo\nbar" must not contain graphical characters or "\n"')
        ->and($messages)->toBe(['notGraph' => '"foo\nbar" must not contain graphical characters or "\n"']),
));
