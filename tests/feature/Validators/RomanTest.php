<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard roman template validation', catchAll(
    fn() => v::roman()->assert(1234),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1234 must be a valid Roman numeral')
        ->and($fullMessage)->toBe('- 1234 must be a valid Roman numeral')
        ->and($messages)->toBe(['roman' => '1234 must be a valid Roman numeral']),
));

test('Standard roman template validation (inverted)', catchAll(
    fn() => v::not(v::roman())->assert('XL'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"XL" must not be a valid Roman numeral')
        ->and($fullMessage)->toBe('- "XL" must not be a valid Roman numeral')
        ->and($messages)->toBe(['notRoman' => '"XL" must not be a valid Roman numeral']),
));
