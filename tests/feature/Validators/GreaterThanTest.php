<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('GreaterThan default template with numeric comparison', catchAll(
    fn() => v::greaterThan(21)->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('12 must be greater than 21')
        ->and($fullMessage)->toBe('- 12 must be greater than 21')
        ->and($messages)->toBe(['greaterThan' => '12 must be greater than 21']),
));

test('GreaterThan default template with string comparison and negative assertion', catchAll(
    fn() => v::not(v::greaterThan('yesterday'))->assert('today'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"today" must not be greater than "yesterday"')
        ->and($fullMessage)->toBe('- "today" must not be greater than "yesterday"')
        ->and($messages)->toBe(['notGreaterThan' => '"today" must not be greater than "yesterday"']),
));

test('GreaterThan default template with date comparison', catchAll(
    fn() => v::greaterThan('2018-09-09')->assert('1988-09-09'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1988-09-09" must be greater than "2018-09-09"')
        ->and($fullMessage)->toBe('- "1988-09-09" must be greater than "2018-09-09"')
        ->and($messages)->toBe(['greaterThan' => '"1988-09-09" must be greater than "2018-09-09"']),
));
