<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
*/

declare(strict_types=1);

test('Standard printable template validation', catchAll(
    fn() => v::printable()->assert('foo' . chr(10) . 'bar'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"foo\nbar" must contain only printable characters')
        ->and($fullMessage)->toBe('- "foo\nbar" must contain only printable characters')
        ->and($messages)->toBe(['printable' => '"foo\nbar" must contain only printable characters']),
));

test('Standard printable template validation (inverted)', catchAll(
    fn() => v::not(v::printable())->assert('abc123'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abc123" must not contain printable characters')
        ->and($fullMessage)->toBe('- "abc123" must not contain printable characters')
        ->and($messages)->toBe(['notPrintable' => '"abc123" must not contain printable characters']),
));

test('Extra printable template validation with additional characters', catchAll(
    fn() => v::printable(chr(10))->assert('foo' . chr(9) . 'bar'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"foo\tbar" must contain only printable characters and "\n"')
        ->and($fullMessage)->toBe('- "foo\tbar" must contain only printable characters and "\n"')
        ->and($messages)->toBe(['printable' => '"foo\tbar" must contain only printable characters and "\n"']),
));

test('Extra printable template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::printable(' '))->assert('hello world'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"hello world" must not contain printable characters or " "')
        ->and($fullMessage)->toBe('- "hello world" must not contain printable characters or " "')
        ->and($messages)->toBe(['notPrintable' => '"hello world" must not contain printable characters or " "']),
));
