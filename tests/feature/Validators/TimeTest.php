<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Time default template with invalid date input', catchAll(
    fn() => v::time()->assert('2018-01-30'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"2018-01-30" must be a valid time in the format "23:59:59"')
        ->and($fullMessage)->toBe('- "2018-01-30" must be a valid time in the format "23:59:59"')
        ->and($messages)->toBe(['time' => '"2018-01-30" must be a valid time in the format "23:59:59"']),
));

test('Time default template with negative assertion', catchAll(
    fn() => v::not(v::time())->assert('09:25:46'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"09:25:46" must not be a valid time in the format "23:59:59"')
        ->and($fullMessage)->toBe('- "09:25:46" must not be a valid time in the format "23:59:59"')
        ->and($messages)->toBe(['notTime' => '"09:25:46" must not be a valid time in the format "23:59:59"']),
));

test('Time custom format template with invalid input', catchAll(
    fn() => v::not(v::time('g:i A'))->assert('8:13 AM'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"8:13 AM" must not be a valid time in the format "11:59 PM"')
        ->and($fullMessage)->toBe('- "8:13 AM" must not be a valid time in the format "11:59 PM"')
        ->and($messages)->toBe(['notTime' => '"8:13 AM" must not be a valid time in the format "11:59 PM"']),
));
