<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard leapYear template validation', catchAll(
    fn() => v::leapYear()->assert('2009'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"2009" must be a valid leap year')
        ->and($fullMessage)->toBe('- "2009" must be a valid leap year')
        ->and($messages)->toBe(['leapYear' => '"2009" must be a valid leap year']),
));

test('Standard leapYear template validation (inverted)', catchAll(
    fn() => v::not(v::leapYear())->assert('2008'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"2008" must not be a leap year')
        ->and($fullMessage)->toBe('- "2008" must not be a leap year')
        ->and($messages)->toBe(['notLeapYear' => '"2008" must not be a leap year']),
));
