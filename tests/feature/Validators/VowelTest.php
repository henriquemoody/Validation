<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard vowel template validation', catchAll(
    fn() => v::vowel()->assert('bcd'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bcd" must consist of vowels only')
        ->and($fullMessage)->toBe('- "bcd" must consist of vowels only')
        ->and($messages)->toBe(['vowel' => '"bcd" must consist of vowels only']),
));

test('Standard vowel template validation (inverted)', catchAll(
    fn() => v::not(v::vowel())->assert('aeiou'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"aeiou" must not consist of vowels only')
        ->and($fullMessage)->toBe('- "aeiou" must not consist of vowels only')
        ->and($messages)->toBe(['notVowel' => '"aeiou" must not consist of vowels only']),
));

test('Extra vowel template validation with additional characters', catchAll(
    fn() => v::vowel('b')->assert('cdf'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"cdf" must consist of vowels and "b"')
        ->and($fullMessage)->toBe('- "cdf" must consist of vowels and "b"')
        ->and($messages)->toBe(['vowel' => '"cdf" must consist of vowels and "b"']),
));

test('Extra vowel template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::vowel('xyz'))->assert('aeiouxyz'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"aeiouxyz" must not consist of vowels or "xyz"')
        ->and($fullMessage)->toBe('- "aeiouxyz" must not consist of vowels or "xyz"')
        ->and($messages)->toBe(['notVowel' => '"aeiouxyz" must not consist of vowels or "xyz"']),
));
