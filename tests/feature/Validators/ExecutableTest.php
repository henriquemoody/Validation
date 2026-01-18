<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard executable template validation', catchAll(
    fn() => v::executable()->assert('bar'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bar" must be an executable file')
        ->and($fullMessage)->toBe('- "bar" must be an executable file')
        ->and($messages)->toBe(['executable' => '"bar" must be an executable file']),
));

test('Standard executable template validation (inverted)', catchAll(
    fn() => v::not(v::executable())->assert('tests/fixtures/executable'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/executable" must not be an executable file')
        ->and($fullMessage)->toBe('- "tests/fixtures/executable" must not be an executable file')
        ->and($messages)->toBe(['notExecutable' => '"tests/fixtures/executable" must not be an executable file']),
));
