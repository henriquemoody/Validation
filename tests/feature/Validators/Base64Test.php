<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard base64 template validation', catchAll(
    fn() => v::base64()->assert('=c3VyZS4'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"=c3VyZS4" must be a base64 encoded string')
        ->and($fullMessage)->toBe('- "=c3VyZS4" must be a base64 encoded string')
        ->and($messages)->toBe(['base64' => '"=c3VyZS4" must be a base64 encoded string']),
));

test('Standard base64 template validation (inverted)', catchAll(
    fn() => v::not(v::base64())->assert('c3VyZS4='),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"c3VyZS4=" must not be a base64 encoded string')
        ->and($fullMessage)->toBe('- "c3VyZS4=" must not be a base64 encoded string')
        ->and($messages)->toBe(['notBase64' => '"c3VyZS4=" must not be a base64 encoded string']),
));
