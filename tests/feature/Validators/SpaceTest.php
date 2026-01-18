<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
*/

declare(strict_types=1);

test('Standard space template validation', catchAll(
    fn() => v::space()->assert('ab'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"ab" must contain only space characters')
        ->and($fullMessage)->toBe('- "ab" must contain only space characters')
        ->and($messages)->toBe(['space' => '"ab" must contain only space characters']),
));

test('Standard space template validation (inverted)', catchAll(
    fn() => v::not(v::space())->assert("\t"),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"\t" must not contain space characters')
        ->and($fullMessage)->toBe('- "\t" must not contain space characters')
        ->and($messages)->toBe(['notSpace' => '"\t" must not contain space characters']),
));

test('Extra space template validation with additional characters', catchAll(
    fn() => v::space('abc')->assert('def'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"def" must contain only space characters and "abc"')
        ->and($fullMessage)->toBe('- "def" must contain only space characters and "abc"')
        ->and($messages)->toBe(['space' => '"def" must contain only space characters and "abc"']),
));

test('Extra space template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::space('abc'))->assert('  '),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"  " must not contain space characters or "abc"')
        ->and($fullMessage)->toBe('- "  " must not contain space characters or "abc"')
        ->and($messages)->toBe(['notSpace' => '"  " must not contain space characters or "abc"']),
));
