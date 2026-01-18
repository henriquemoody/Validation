<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard negative template validation', catchAll(
    fn() => v::negative()->assert(16),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('16 must be a negative number')
        ->and($fullMessage)->toBe('- 16 must be a negative number')
        ->and($messages)->toBe(['negative' => '16 must be a negative number']),
));

test('Standard negative template validation (inverted)', catchAll(
    fn() => v::not(v::negative())->assert(-10),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-10 must not be a negative number')
        ->and($fullMessage)->toBe('- -10 must not be a negative number')
        ->and($messages)->toBe(['notNegative' => '-10 must not be a negative number']),
));
