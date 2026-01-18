<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard lessThanOrEqual template validation', catchAll(
    fn() => v::lessThanOrEqual(10)->assert(11),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('11 must be less than or equal to 10')
        ->and($fullMessage)->toBe('- 11 must be less than or equal to 10')
        ->and($messages)->toBe(['lessThanOrEqual' => '11 must be less than or equal to 10']),
));

test('Standard lessThanOrEqual template validation (inverted)', catchAll(
    fn() => v::not(v::lessThanOrEqual(10))->assert(5),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('5 must be greater than 10')
        ->and($fullMessage)->toBe('- 5 must be greater than 10')
        ->and($messages)->toBe(['notLessThanOrEqual' => '5 must be greater than 10']),
));
