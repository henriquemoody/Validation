<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Validators\AlwaysInvalid;

test('Standard alwaysInvalid template validation', catchAll(
    fn() => v::alwaysInvalid()->assert('whatever'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"whatever" must be valid')
        ->and($fullMessage)->toBe('- "whatever" must be valid')
        ->and($messages)->toBe(['alwaysInvalid' => '"whatever" must be valid']),
));

test('Simple alwaysInvalid template validation', catchAll(
    fn() => v::templated(AlwaysInvalid::TEMPLATE_SIMPLE, v::alwaysInvalid())->assert('whatever'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"whatever" is invalid')
        ->and($fullMessage)->toBe('- "whatever" is invalid')
        ->and($messages)->toBe(['alwaysInvalid' => '"whatever" is invalid']),
));
