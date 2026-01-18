<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard uppercase template validation', catchAll(
    fn() => v::uppercase()->assert('lowercase'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"lowercase" must contain only uppercase letters')
        ->and($fullMessage)->toBe('- "lowercase" must contain only uppercase letters')
        ->and($messages)->toBe(['uppercase' => '"lowercase" must contain only uppercase letters']),
));

test('Standard uppercase template validation (inverted)', catchAll(
    fn() => v::not(v::uppercase())->assert('UPPERCASE'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"UPPERCASE" must not contain only uppercase letters')
        ->and($fullMessage)->toBe('- "UPPERCASE" must not contain only uppercase letters')
        ->and($messages)->toBe(['notUppercase' => '"UPPERCASE" must not contain only uppercase letters']),
));
