<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard between template validation', catchAll(
    fn() => v::between(1, 2)->assert(0),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('0 must be between 1 and 2')
        ->and($fullMessage)->toBe('- 0 must be between 1 and 2')
        ->and($messages)->toBe(['between' => '0 must be between 1 and 2']),
));

test('Standard between template validation (inverted)', catchAll(
    fn() => v::not(v::between('yesterday', 'tomorrow'))->assert('today'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"today" must not be between "yesterday" and "tomorrow"')
        ->and($fullMessage)->toBe('- "today" must not be between "yesterday" and "tomorrow"')
        ->and($messages)->toBe(['notBetween' => '"today" must not be between "yesterday" and "tomorrow"']),
));

test('Between template validation with characters', catchAll(
    fn() => v::between('a', 'c')->assert('d'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"d" must be between "a" and "c"')
        ->and($fullMessage)->toBe('- "d" must be between "a" and "c"')
        ->and($messages)->toBe(['between' => '"d" must be between "a" and "c"']),
));

test('Between template validation with characters (inverted)', catchAll(
    fn() => v::not(v::between(-INF, INF))->assert(0),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('0 must not be between `-INF` and `INF`')
        ->and($fullMessage)->toBe('- 0 must not be between `-INF` and `INF`')
        ->and($messages)->toBe(['notBetween' => '0 must not be between `-INF` and `INF`']),
));
