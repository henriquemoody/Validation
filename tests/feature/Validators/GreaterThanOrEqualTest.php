<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('GreaterThanOrEqual default template with infinity comparison', catchAll(
    fn() => v::greaterThanOrEqual(INF)->assert(10),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('10 must be greater than or equal to `INF`')
        ->and($fullMessage)->toBe('- 10 must be greater than or equal to `INF`')
        ->and($messages)->toBe(['greaterThanOrEqual' => '10 must be greater than or equal to `INF`']),
));

test('GreaterThanOrEqual default template with negative assertion', catchAll(
    fn() => v::not(v::greaterThanOrEqual(5))->assert(INF),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`INF` must be less than 5')
        ->and($fullMessage)->toBe('- `INF` must be less than 5')
        ->and($messages)->toBe(['notGreaterThanOrEqual' => '`INF` must be less than 5']),
));

test('GreaterThanOrEqual default template with date comparison', catchAll(
    fn() => v::greaterThanOrEqual('today')->assert('yesterday'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"yesterday" must be greater than or equal to "today"')
        ->and($fullMessage)->toBe('- "yesterday" must be greater than or equal to "today"')
        ->and($messages)->toBe(['greaterThanOrEqual' => '"yesterday" must be greater than or equal to "today"']),
));
