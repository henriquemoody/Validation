<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard float template validation', catchAll(
    fn() => v::floatVal()->assert('abc'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abc" must be a float value')
        ->and($fullMessage)->toBe('- "abc" must be a float value')
        ->and($messages)->toBe(['floatVal' => '"abc" must be a float value']),
));

test('Standard float template validation (inverted)', catchAll(
    fn() => v::not(v::floatVal())->assert(1.5),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1.5 must not be a float value')
        ->and($fullMessage)->toBe('- 1.5 must not be a float value')
        ->and($messages)->toBe(['notFloatVal' => '1.5 must not be a float value']),
));
