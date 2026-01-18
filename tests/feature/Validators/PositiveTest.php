<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard positive template validation', catchAll(
    fn() => v::positive()->assert(-10),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-10 must be a positive number')
        ->and($fullMessage)->toBe('- -10 must be a positive number')
        ->and($messages)->toBe(['positive' => '-10 must be a positive number']),
));

test('Standard positive template validation (inverted)', catchAll(
    fn() => v::not(v::positive())->assert(16),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('16 must not be a positive number')
        ->and($fullMessage)->toBe('- 16 must not be a positive number')
        ->and($messages)->toBe(['notPositive' => '16 must not be a positive number']),
));
