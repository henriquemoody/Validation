<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard xdigit template validation', catchAll(
    fn() => v::xdigit()->assert('aaa%a'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"aaa%a" must only contain hexadecimal digits')
        ->and($fullMessage)->toBe('- "aaa%a" must only contain hexadecimal digits')
        ->and($messages)->toBe(['xdigit' => '"aaa%a" must only contain hexadecimal digits']),
));

test('Standard xdigit template validation (inverted)', catchAll(
    fn() => v::not(v::xdigit())->assert('abc123'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abc123" must not only contain hexadecimal digits')
        ->and($fullMessage)->toBe('- "abc123" must not only contain hexadecimal digits')
        ->and($messages)->toBe(['notXdigit' => '"abc123" must not only contain hexadecimal digits']),
));

test('Extra xdigit template validation with additional characters', catchAll(
    fn() => v::xdigit(' ')->assert('bbb%b'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bbb%b" must contain hexadecimal digits and " "')
        ->and($fullMessage)->toBe('- "bbb%b" must contain hexadecimal digits and " "')
        ->and($messages)->toBe(['xdigit' => '"bbb%b" must contain hexadecimal digits and " "']),
));

test('Extra xdigit template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::xdigit('% '))->assert('def456 %'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"def456 %" must not contain hexadecimal digits or "% "')
        ->and($fullMessage)->toBe('- "def456 %" must not contain hexadecimal digits or "% "')
        ->and($messages)->toBe(['notXdigit' => '"def456 %" must not contain hexadecimal digits or "% "']),
));
