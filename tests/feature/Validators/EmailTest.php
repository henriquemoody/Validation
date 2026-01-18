<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard email template validation', catchAll(
    fn() => v::email()->assert('batman'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"batman" must be a valid email address')
        ->and($fullMessage)->toBe('- "batman" must be a valid email address')
        ->and($messages)->toBe(['email' => '"batman" must be a valid email address']),
));

test('Standard email template validation (inverted)', catchAll(
    fn() => v::not(v::email())->assert('bruce.wayne@gothancity.com'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bruce.wayne@gothancity.com" must not be an email address')
        ->and($fullMessage)->toBe('- "bruce.wayne@gothancity.com" must not be an email address')
        ->and($messages)->toBe(['notEmail' => '"bruce.wayne@gothancity.com" must not be an email address']),
));
