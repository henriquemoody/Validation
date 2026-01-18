<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard directory template validation', catchAll(
    fn() => v::directory()->assert('batman'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"batman" must be a directory')
        ->and($fullMessage)->toBe('- "batman" must be a directory')
        ->and($messages)->toBe(['directory' => '"batman" must be a directory']),
));

test('Standard directory template validation (inverted)', catchAll(
    fn() => v::not(v::directory())->assert(dirname('/etc/')),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"/" must not be a directory')
        ->and($fullMessage)->toBe('- "/" must not be a directory')
        ->and($messages)->toBe(['notDirectory' => '"/" must not be a directory']),
));
