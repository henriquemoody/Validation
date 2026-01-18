<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Identical default template with numeric comparison', catchAll(
    fn() => v::identical(123)->assert(321),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('321 must be identical to 123')
        ->and($fullMessage)->toBe('- 321 must be identical to 123')
        ->and($messages)->toBe(['identical' => '321 must be identical to 123']),
));

test('Identical default template with negative assertion', catchAll(
    fn() => v::not(v::identical(321))->assert(321),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('321 must not be identical to 321')
        ->and($fullMessage)->toBe('- 321 must not be identical to 321')
        ->and($messages)->toBe(['notIdentical' => '321 must not be identical to 321']),
));
