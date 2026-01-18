<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard boolVal template validation', catchAll(
    fn() => v::boolVal()->assert('ok'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"ok" must be a boolean value')
        ->and($fullMessage)->toBe('- "ok" must be a boolean value')
        ->and($messages)->toBe(['boolVal' => '"ok" must be a boolean value']),
));

test('Standard boolVal template validation (inverted)', catchAll(
    fn() => v::not(v::boolVal())->assert('yes'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"yes" must not be a boolean value')
        ->and($fullMessage)->toBe('- "yes" must not be a boolean value')
        ->and($messages)->toBe(['notBoolVal' => '"yes" must not be a boolean value']),
));
