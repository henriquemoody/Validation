<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard macAddress template validation', catchAll(
    fn() => v::macAddress()->assert('90-bc-nk:1a-dd-cc'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"90-bc-nk:1a-dd-cc" must be a valid MAC address')
        ->and($fullMessage)->toBe('- "90-bc-nk:1a-dd-cc" must be a valid MAC address')
        ->and($messages)->toBe(['macAddress' => '"90-bc-nk:1a-dd-cc" must be a valid MAC address']),
));

test('Standard macAddress template validation (inverted)', catchAll(
    fn() => v::not(v::macAddress())->assert('AF:0F:bd:12:44:ba'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"AF:0F:bd:12:44:ba" must not be a valid MAC address')
        ->and($fullMessage)->toBe('- "AF:0F:bd:12:44:ba" must not be a valid MAC address')
        ->and($messages)->toBe(['notMacAddress' => '"AF:0F:bd:12:44:ba" must not be a valid MAC address']),
));
