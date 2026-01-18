<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard alnum template validation', catchAll(
    fn() => v::alnum()->assert('abc%1'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abc%1" must contain only letters (a-z) and digits (0-9)')
        ->and($fullMessage)->toBe('- "abc%1" must contain only letters (a-z) and digits (0-9)')
        ->and($messages)->toBe(['alnum' => '"abc%1" must contain only letters (a-z) and digits (0-9)']),
));

test('Standard alnum template validation (inverted)', catchAll(
    fn() => v::not(v::alnum())->assert('abcd3'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abcd3" must not contain letters (a-z) or digits (0-9)')
        ->and($fullMessage)->toBe('- "abcd3" must not contain letters (a-z) or digits (0-9)')
        ->and($messages)->toBe(['notAlnum' => '"abcd3" must not contain letters (a-z) or digits (0-9)']),
));

test('Extra alnum template validation with additional characters', catchAll(
    fn() => v::alnum(' ')->assert('abc%2'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abc%2" must contain only letters (a-z), digits (0-9), and " "')
        ->and($fullMessage)->toBe('- "abc%2" must contain only letters (a-z), digits (0-9), and " "')
        ->and($messages)->toBe(['alnum' => '"abc%2" must contain only letters (a-z), digits (0-9), and " "']),
));

test('Extra alnum template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::alnum(' '))->assert('ab cd12'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"ab cd12" must not contain letters (a-z), digits (0-9), or " "')
        ->and($fullMessage)->toBe('- "ab cd12" must not contain letters (a-z), digits (0-9), or " "')
        ->and($messages)->toBe(['notAlnum' => '"ab cd12" must not contain letters (a-z), digits (0-9), or " "']),
));
