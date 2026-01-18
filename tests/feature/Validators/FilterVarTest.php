<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard filterVar template validation', catchAll(
    fn() => v::filterVar(FILTER_VALIDATE_EMAIL)->assert(1.5),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1.5 must be valid')
        ->and($fullMessage)->toBe('- 1.5 must be valid')
        ->and($messages)->toBe(['filterVar' => '1.5 must be valid']),
));

test('Standard filterVar template validation (inverted)', catchAll(
    fn() => v::not(v::filterVar(FILTER_VALIDATE_FLOAT))->assert(1.0),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1.0 must not be valid')
        ->and($fullMessage)->toBe('- 1.0 must not be valid')
        ->and($messages)->toBe(['notFilterVar' => '1.0 must not be valid']),
));
