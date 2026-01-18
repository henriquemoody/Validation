<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Standard date/time template validation', catchAll(
    fn() => v::dateTime()->assert('FooBarBazz'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"FooBarBazz" must be a valid date/time')
        ->and($fullMessage)->toBe('- "FooBarBazz" must be a valid date/time')
        ->and($messages)->toBe(['dateTime' => '"FooBarBazz" must be a valid date/time']),
));

test('Standard date/time template validation (inverted)', catchAll(
    fn() => v::not(v::dateTime())->assert('1988-09-09'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1988-09-09" must not be a valid date/time')
        ->and($fullMessage)->toBe('- "1988-09-09" must not be a valid date/time')
        ->and($messages)->toBe(['notDateTime' => '"1988-09-09" must not be a valid date/time']),
));

test('Format date/time template validation', catchAll(
    fn() => v::dateTime('c')->assert('06-12-1995'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"06-12-1995" must be a valid date/time in the format "2005-12-30T01:02:03+00:00"')
        ->and($fullMessage)->toBe('- "06-12-1995" must be a valid date/time in the format "2005-12-30T01:02:03+00:00"')
        ->and($messages)->toBe(['dateTime' => '"06-12-1995" must be a valid date/time in the format "2005-12-30T01:02:03+00:00"']),
));

test('Format date/time template validation (inverted)', catchAll(
    fn() => v::not(v::dateTime('Y-m-d'))->assert('1988-09-09'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1988-09-09" must not be a valid date/time in the format "2005-12-30"')
        ->and($fullMessage)->toBe('- "1988-09-09" must not be a valid date/time in the format "2005-12-30"')
        ->and($messages)->toBe(['notDateTime' => '"1988-09-09" must not be a valid date/time in the format "2005-12-30"']),
));
