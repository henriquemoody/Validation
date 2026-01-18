<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard factor template validation', catchAll(
    fn() => v::factor(3)->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('2 must be a factor of 3')
        ->and($fullMessage)->toBe('- 2 must be a factor of 3')
        ->and($messages)->toBe(['factor' => '2 must be a factor of 3']),
));

test('Standard factor template validation (inverted)', catchAll(
    fn() => v::not(v::factor(0))->assert(300),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('300 must not be a factor of 0')
        ->and($fullMessage)->toBe('- 300 must not be a factor of 0')
        ->and($messages)->toBe(['notFactor' => '300 must not be a factor of 0']),
));
