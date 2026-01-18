<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Standard pesel template validation', catchAll(
    fn() => v::pesel()->assert('21120209251'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"21120209251" must be a valid PESEL')
        ->and($fullMessage)->toBe('- "21120209251" must be a valid PESEL')
        ->and($messages)->toBe(['pesel' => '"21120209251" must be a valid PESEL']),
));

test('Standard pesel template validation (inverted)', catchAll(
    fn() => v::not(v::pesel())->assert('21120209256'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"21120209256" must not be a valid PESEL')
        ->and($fullMessage)->toBe('- "21120209256" must not be a valid PESEL')
        ->and($messages)->toBe(['notPesel' => '"21120209256" must not be a valid PESEL']),
));
