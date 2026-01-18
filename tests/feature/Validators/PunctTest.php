<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
*/

declare(strict_types=1);

test('Standard punct template validation', catchAll(
    fn() => v::punct()->assert('abc'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abc" must contain only punctuation characters')
        ->and($fullMessage)->toBe('- "abc" must contain only punctuation characters')
        ->and($messages)->toBe(['punct' => '"abc" must contain only punctuation characters']),
));

test('Standard punct template validation (inverted)', catchAll(
    fn() => v::not(v::punct())->assert('!.?'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"!.?" must not contain punctuation characters')
        ->and($fullMessage)->toBe('- "!.?" must not contain punctuation characters')
        ->and($messages)->toBe(['notPunct' => '"!.?" must not contain punctuation characters']),
));

test('Extra punct template validation with additional characters', catchAll(
    fn() => v::punct('abc')->assert('def'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"def" must contain only punctuation characters and "abc"')
        ->and($fullMessage)->toBe('- "def" must contain only punctuation characters and "abc"')
        ->and($messages)->toBe(['punct' => '"def" must contain only punctuation characters and "abc"']),
));

test('Extra punct template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::punct('abc'))->assert('.!?'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('".!?" must not contain punctuation characters or "abc"')
        ->and($fullMessage)->toBe('- ".!?" must not contain punctuation characters or "abc"')
        ->and($messages)->toBe(['notPunct' => '".!?" must not contain punctuation characters or "abc"']),
));
