<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard luhn template validation', catchAll(
    fn() => v::luhn()->assert('340316193809334'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"340316193809334" must be a valid Luhn number')
        ->and($fullMessage)->toBe('- "340316193809334" must be a valid Luhn number')
        ->and($messages)->toBe(['luhn' => '"340316193809334" must be a valid Luhn number']),
));

test('Standard luhn template validation (inverted)', catchAll(
    fn() => v::not(v::luhn())->assert('6011000990139424'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"6011000990139424" must not be a valid Luhn number')
        ->and($fullMessage)->toBe('- "6011000990139424" must not be a valid Luhn number')
        ->and($messages)->toBe(['notLuhn' => '"6011000990139424" must not be a valid Luhn number']),
));
