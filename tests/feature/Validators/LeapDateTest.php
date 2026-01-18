<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard leapDate template validation', catchAll(
    fn() => v::leapDate('Y-m-d')->assert('1989-02-29'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1989-02-29" must be a valid leap date')
        ->and($fullMessage)->toBe('- "1989-02-29" must be a valid leap date')
        ->and($messages)->toBe(['leapDate' => '"1989-02-29" must be a valid leap date']),
));

test('Standard leapDate template validation (inverted)', catchAll(
    fn() => v::not(v::leapDate('Y-m-d'))->assert('1988-02-29'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1988-02-29" must not be a leap date')
        ->and($fullMessage)->toBe('- "1988-02-29" must not be a leap date')
        ->and($messages)->toBe(['notLeapDate' => '"1988-02-29" must not be a leap date']),
));
