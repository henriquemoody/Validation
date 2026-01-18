<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard isbn template validation', catchAll(
    fn() => v::isbn()->assert('978 10 596 52068 7'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"978 10 596 52068 7" must be a valid ISBN')
        ->and($fullMessage)->toBe('- "978 10 596 52068 7" must be a valid ISBN')
        ->and($messages)->toBe(['isbn' => '"978 10 596 52068 7" must be a valid ISBN']),
));

test('Standard isbn template validation (inverted)', catchAll(
    fn() => v::not(v::isbn())->assert('978 0 596 52068 7'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"978 0 596 52068 7" must not be a valid ISBN')
        ->and($fullMessage)->toBe('- "978 0 596 52068 7" must not be a valid ISBN')
        ->and($messages)->toBe(['notIsbn' => '"978 0 596 52068 7" must not be a valid ISBN']),
));
