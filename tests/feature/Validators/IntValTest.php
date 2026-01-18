<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard intVal template validation', catchAll(
    fn() => v::intVal()->assert('42.33'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"42.33" must be an integer value')
        ->and($fullMessage)->toBe('- "42.33" must be an integer value')
        ->and($messages)->toBe(['intVal' => '"42.33" must be an integer value']),
));

test('Standard intVal template validation (inverted)', catchAll(
    fn() => v::not(v::intVal())->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('2 must not be an integer value')
        ->and($fullMessage)->toBe('- 2 must not be an integer value')
        ->and($messages)->toBe(['notIntVal' => '2 must not be an integer value']),
));
