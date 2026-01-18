<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard domain template validation', catchAll(
    fn() => v::domain()->assert('batman'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"batman" must be a valid domain')
        ->and($fullMessage)->toBe('- "batman" must be a valid domain')
        ->and($messages)->toBe(['domain' => '"batman" must be a valid domain']),
));

test('Standard domain template validation (inverted)', catchAll(
    fn() => v::not(v::domain())->assert('r--w.com'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"r--w.com" must not be a valid domain')
        ->and($fullMessage)->toBe('- "r--w.com" must not be a valid domain')
        ->and($messages)->toBe(['notDomain' => '"r--w.com" must not be a valid domain']),
));
