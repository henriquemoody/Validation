<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard credit card template validation', catchAll(
    fn() => v::creditCard()->assert(1234567890123456),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1234567890123456 must be a valid credit card number')
        ->and($fullMessage)->toBe('- 1234567890123456 must be a valid credit card number')
        ->and($messages)->toBe(['creditCard' => '1234567890123456 must be a valid credit card number']),
));

test('Standard credit card template validation (inverted)', catchAll(
    fn() => v::not(v::creditCard())->assert(5555444433331111),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('5555444433331111 must not be a valid credit card number')
        ->and($fullMessage)->toBe('- 5555444433331111 must not be a valid credit card number')
        ->and($messages)->toBe(['notCreditCard' => '5555444433331111 must not be a valid credit card number']),
));

test('Branched credit card template validation', catchAll(
    fn() => v::creditCard('Visa')->assert(3566002020360505),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('3566002020360505 must be a valid Visa credit card number')
        ->and($fullMessage)->toBe('- 3566002020360505 must be a valid Visa credit card number')
        ->and($messages)->toBe(['creditCard' => '3566002020360505 must be a valid Visa credit card number']),
));

test('Branched credit card template validation (inverted)', catchAll(
    fn() => v::not(v::creditCard('MasterCard'))->assert(5555555555554444),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('5555555555554444 must not be a valid MasterCard credit card number')
        ->and($fullMessage)->toBe('- 5555555555554444 must not be a valid MasterCard credit card number')
        ->and($messages)->toBe(['notCreditCard' => '5555555555554444 must not be a valid MasterCard credit card number']),
));
