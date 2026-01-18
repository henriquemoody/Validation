<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard decimal template validation', catchAll(
    fn() => v::decimal(3)->assert(0.1234),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('0.1234 must have 3 decimals')
        ->and($fullMessage)->toBe('- 0.1234 must have 3 decimals')
        ->and($messages)->toBe(['decimal' => '0.1234 must have 3 decimals']),
));

test('Standard decimal template validation (inverted)', catchAll(
    fn() => v::not(v::decimal(5))->assert(0.12345),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('0.12345 must not have 5 decimals')
        ->and($fullMessage)->toBe('- 0.12345 must not have 5 decimals')
        ->and($messages)->toBe(['notDecimal' => '0.12345 must not have 5 decimals']),
));
