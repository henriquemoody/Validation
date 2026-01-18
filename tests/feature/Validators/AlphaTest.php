<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard alpha template validation', catchAll(
    fn() => v::alpha()->assert('aaa%a'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"aaa%a" must contain only letters (a-z)')
        ->and($fullMessage)->toBe('- "aaa%a" must contain only letters (a-z)')
        ->and($messages)->toBe(['alpha' => '"aaa%a" must contain only letters (a-z)']),
));

test('Standard alpha template validation (inverted)', catchAll(
    fn() => v::not(v::alpha())->assert('ccccc'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"ccccc" must not contain letters (a-z)')
        ->and($fullMessage)->toBe('- "ccccc" must not contain letters (a-z)')
        ->and($messages)->toBe(['notAlpha' => '"ccccc" must not contain letters (a-z)']),
));

test('Extra alpha template validation with additional characters', catchAll(
    fn() => v::alpha(' ')->assert('bbb%b'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bbb%b" must contain only letters (a-z) and " "')
        ->and($fullMessage)->toBe('- "bbb%b" must contain only letters (a-z) and " "')
        ->and($messages)->toBe(['alpha' => '"bbb%b" must contain only letters (a-z) and " "']),
));

test('Extra alpha template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::alpha(' '))->assert('dddd'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"dddd" must not contain letters (a-z) or " "')
        ->and($fullMessage)->toBe('- "dddd" must not contain letters (a-z) or " "')
        ->and($messages)->toBe(['notAlpha' => '"dddd" must not contain letters (a-z) or " "']),
));
