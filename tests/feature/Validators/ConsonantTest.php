<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard consonant template validation', catchAll(
    fn() => v::consonant()->assert('aeiou'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"aeiou" must only contain consonants')
        ->and($fullMessage)->toBe('- "aeiou" must only contain consonants')
        ->and($messages)->toBe(['consonant' => '"aeiou" must only contain consonants']),
));

test('Standard consonant template validation (inverted)', catchAll(
    fn() => v::not(v::consonant())->assert('bcd'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bcd" must not contain consonants')
        ->and($fullMessage)->toBe('- "bcd" must not contain consonants')
        ->and($messages)->toBe(['notConsonant' => '"bcd" must not contain consonants']),
));

test('Extra consonant template validation with additional characters', catchAll(
    fn() => v::consonant('d')->assert('daeiou'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"daeiou" must only contain consonants and "d"')
        ->and($fullMessage)->toBe('- "daeiou" must only contain consonants and "d"')
        ->and($messages)->toBe(['consonant' => '"daeiou" must only contain consonants and "d"']),
));

test('Extra consonant template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::consonant('a'))->assert('abcd'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abcd" must not contain consonants or "a"')
        ->and($fullMessage)->toBe('- "abcd" must not contain consonants or "a"')
        ->and($messages)->toBe(['notConsonant' => '"abcd" must not contain consonants or "a"']),
));
