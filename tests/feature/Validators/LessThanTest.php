<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('LessThan default template with numeric comparison', catchAll(
    fn() => v::lessThan(12)->assert(21),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('21 must be less than 12')
        ->and($fullMessage)->toBe('- 21 must be less than 12')
        ->and($messages)->toBe(['lessThan' => '21 must be less than 12']),
));

test('LessThan default template with string comparison and negative assertion', catchAll(
    fn() => v::not(v::lessThan('today'))->assert('yesterday'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"yesterday" must not be less than "today"')
        ->and($fullMessage)->toBe('- "yesterday" must not be less than "today"')
        ->and($messages)->toBe(['notLessThan' => '"yesterday" must not be less than "today"']),
));

test('LessThan default template with date comparison', catchAll(
    fn() => v::lessThan('1988-09-09')->assert('2018-09-09'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"2018-09-09" must be less than "1988-09-09"')
        ->and($fullMessage)->toBe('- "2018-09-09" must be less than "1988-09-09"')
        ->and($messages)->toBe(['lessThan' => '"2018-09-09" must be less than "1988-09-09"']),
));
