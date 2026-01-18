<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard numericVal template validation', catchAll(
    fn() => v::numericVal()->assert('a'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"a" must be a numeric value')
        ->and($fullMessage)->toBe('- "a" must be a numeric value')
        ->and($messages)->toBe(['numericVal' => '"a" must be a numeric value']),
));

test('Standard numericVal template validation (inverted)', catchAll(
    fn() => v::not(v::numericVal())->assert('1'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1" must not be a numeric value')
        ->and($fullMessage)->toBe('- "1" must not be a numeric value')
        ->and($messages)->toBe(['notNumericVal' => '"1" must not be a numeric value']),
));
