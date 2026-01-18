<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard version template validation', catchAll(
    fn() => v::version()->assert('1.3.7--'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1.3.7--" must be a version')
        ->and($fullMessage)->toBe('- "1.3.7--" must be a version')
        ->and($messages)->toBe(['version' => '"1.3.7--" must be a version']),
));

test('Standard version template validation (inverted)', catchAll(
    fn() => v::not(v::version())->assert('1.0.0-alpha'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1.0.0-alpha" must not be a version')
        ->and($fullMessage)->toBe('- "1.0.0-alpha" must not be a version')
        ->and($messages)->toBe(['notVersion' => '"1.0.0-alpha" must not be a version']),
));
