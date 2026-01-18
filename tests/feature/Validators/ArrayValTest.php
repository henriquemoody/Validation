<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('ArrayVal default template with string input', catchAll(
    fn() => v::arrayVal()->assert('Bla %123'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"Bla %123" must be an array value')
        ->and($fullMessage)->toBe('- "Bla %123" must be an array value')
        ->and($messages)->toBe(['arrayVal' => '"Bla %123" must be an array value']),
));

test('ArrayVal default template with negative assertion', catchAll(
    fn() => v::not(v::arrayVal())->assert([42]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[42]` must not be an array value')
        ->and($fullMessage)->toBe('- `[42]` must not be an array value')
        ->and($messages)->toBe(['notArrayVal' => '`[42]` must not be an array value']),
));

test('ArrayVal default template with object input', catchAll(
    fn() => v::arrayVal()->assert(new stdClass()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`stdClass {}` must be an array value')
        ->and($fullMessage)->toBe('- `stdClass {}` must be an array value')
        ->and($messages)->toBe(['arrayVal' => '`stdClass {}` must be an array value']),
));
