<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard cnh template validation', catchAll(
    fn() => v::cnh()->assert('bruce wayne'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bruce wayne" must be a valid CNH number')
        ->and($fullMessage)->toBe('- "bruce wayne" must be a valid CNH number')
        ->and($messages)->toBe(['cnh' => '"bruce wayne" must be a valid CNH number']),
));

test('Standard cnh template validation (inverted)', catchAll(
    fn() => v::not(v::cnh())->assert('02650306461'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"02650306461" must not be a valid CNH number')
        ->and($fullMessage)->toBe('- "02650306461" must not be a valid CNH number')
        ->and($messages)->toBe(['notCnh' => '"02650306461" must not be a valid CNH number']),
));
