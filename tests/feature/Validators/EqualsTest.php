<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Equals default template with numeric comparison', catchAll(
    fn() => v::equals(123)->assert(321),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('321 must be equal to 123')
        ->and($fullMessage)->toBe('- 321 must be equal to 123')
        ->and($messages)->toBe(['equals' => '321 must be equal to 123']),
));

test('Equals default template with negative assertion', catchAll(
    fn() => v::not(v::equals(321))->assert(321),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('321 must not be equal to 321')
        ->and($fullMessage)->toBe('- 321 must not be equal to 321')
        ->and($messages)->toBe(['notEquals' => '321 must not be equal to 321']),
));
