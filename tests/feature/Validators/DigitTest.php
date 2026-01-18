<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard digit template validation', catchAll(
    fn() => v::digit()->assert('abc'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abc" must contain only digits (0-9)')
        ->and($fullMessage)->toBe('- "abc" must contain only digits (0-9)')
        ->and($messages)->toBe(['digit' => '"abc" must contain only digits (0-9)']),
));

test('Standard digit template validation (inverted)', catchAll(
    fn() => v::not(v::digit())->assert('123'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"123" must not contain digits (0-9)')
        ->and($fullMessage)->toBe('- "123" must not contain digits (0-9)')
        ->and($messages)->toBe(['notDigit' => '"123" must not contain digits (0-9)']),
));

test('Extra digit template validation with additional characters', catchAll(
    fn() => v::digit('-')->assert('a-b'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"a-b" must contain only digits (0-9) and "-"')
        ->and($fullMessage)->toBe('- "a-b" must contain only digits (0-9) and "-"')
        ->and($messages)->toBe(['digit' => '"a-b" must contain only digits (0-9) and "-"']),
));

test('Extra digit template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::digit('-'))->assert('1-3'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1-3" must not contain digits (0-9) and "-"')
        ->and($fullMessage)->toBe('- "1-3" must not contain digits (0-9) and "-"')
        ->and($messages)->toBe(['notDigit' => '"1-3" must not contain digits (0-9) and "-"']),
));
