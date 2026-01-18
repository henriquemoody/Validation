<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Invalid subdivision code template validation', catchAll(
    fn() => v::subdivisionCode('BR')->assert('XX'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"XX" must be a subdivision code of Brazil')
        ->and($fullMessage)->toBe('- "XX" must be a subdivision code of Brazil')
        ->and($messages)->toBe(['subdivisionCode' => '"XX" must be a subdivision code of Brazil']),
));

test('Invalid subdivision code template validation with number instead of string', catchAll(
    fn() => v::subdivisionCode('BR')->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('12 must be a subdivision code of Brazil')
        ->and($fullMessage)->toBe('- 12 must be a subdivision code of Brazil')
        ->and($messages)->toBe(['subdivisionCode' => '12 must be a subdivision code of Brazil']),
));

test('Valid subdivision code template validation (inverted)', catchAll(
    fn() => v::not(v::subdivisionCode('BR'))->assert('SP'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"SP" must not be a subdivision code of Brazil')
        ->and($fullMessage)->toBe('- "SP" must not be a subdivision code of Brazil')
        ->and($messages)->toBe(['notSubdivisionCode' => '"SP" must not be a subdivision code of Brazil']),
));

test('Valid subdivision code template validation with US code (inverted)', catchAll(
    fn() => v::not(v::subdivisionCode('US'))->assert('CA'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"CA" must not be a subdivision code of United States')
        ->and($fullMessage)->toBe('- "CA" must not be a subdivision code of United States')
        ->and($messages)->toBe(['notSubdivisionCode' => '"CA" must not be a subdivision code of United States']),
));
