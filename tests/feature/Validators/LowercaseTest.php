<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard lowercase template validation', catchAll(
    fn() => v::lowercase()->assert('UPPERCASE'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"UPPERCASE" must contain only lowercase letters')
        ->and($fullMessage)->toBe('- "UPPERCASE" must contain only lowercase letters')
        ->and($messages)->toBe(['lowercase' => '"UPPERCASE" must contain only lowercase letters']),
));

test('Standard lowercase template validation (inverted)', catchAll(
    fn() => v::not(v::lowercase())->assert('lowercase'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"lowercase" must not contain only lowercase letters')
        ->and($fullMessage)->toBe('- "lowercase" must not contain only lowercase letters')
        ->and($messages)->toBe(['notLowercase' => '"lowercase" must not contain only lowercase letters']),
));
