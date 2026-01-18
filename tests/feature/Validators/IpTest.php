<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
*/

declare(strict_types=1);

test('Standard IP template validation', catchAll(
    fn() => v::ip()->assert('257.0.0.1'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"257.0.0.1" must be an IP address')
        ->and($fullMessage)->toBe('- "257.0.0.1" must be an IP address')
        ->and($messages)->toBe(['ip' => '"257.0.0.1" must be an IP address']),
));

test('Standard IP template validation (inverted)', catchAll(
    fn() => v::not(v::ip())->assert('127.0.0.1'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"127.0.0.1" must not be an IP address')
        ->and($fullMessage)->toBe('- "127.0.0.1" must not be an IP address')
        ->and($messages)->toBe(['notIp' => '"127.0.0.1" must not be an IP address']),
));

test('Network range IP template validation', catchAll(
    fn() => v::ip('127.0.1.*')->assert('127.0.0.1'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"127.0.0.1" must be an IP address in the 127.0.1.0-127.0.1.255 range')
        ->and($fullMessage)->toBe('- "127.0.0.1" must be an IP address in the 127.0.1.0-127.0.1.255 range')
        ->and($messages)->toBe(['ip' => '"127.0.0.1" must be an IP address in the 127.0.1.0-127.0.1.255 range']),
));

test('Network range IP template validation (inverted)', catchAll(
    fn() => v::not(v::ip('127.0.1.*'))->assert('127.0.1.1'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"127.0.1.1" must not be an IP address in the 127.0.1.0-127.0.1.255 range')
        ->and($fullMessage)->toBe('- "127.0.1.1" must not be an IP address in the 127.0.1.0-127.0.1.255 range')
        ->and($messages)->toBe(['notIp' => '"127.0.1.1" must not be an IP address in the 127.0.1.0-127.0.1.255 range']),
));
