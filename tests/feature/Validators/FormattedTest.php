<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\StringFormatter\FormatterBuilder as f;

test('input is not a string', catchAll(
    fn() => v::formatted(f::mask('1-'), v::alnum())->assert(new stdClass()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`stdClass {}` must be a string')
        ->and($fullMessage)->toBe('- `stdClass {}` must be a string')
        ->and($messages)->toBe(['alnum' => '`stdClass {}` must be a string']),
));

test('failed validator with masked input', catchAll(
    fn() => v::formatted(f::mask('1-4'), v::email())->assert('not an email'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"****an email" must be an email address')
        ->and($fullMessage)->toBe('- "****an email" must be an email address')
        ->and($messages)->toBe(['email' => '"****an email" must be an email address']),
));

test('failed validator with pattern formatted input', catchAll(
    fn() => v::formatted(f::pattern('#### #### #### ####'), v::creditCard())->assert('1234123412341234'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1234 1234 1234 1234" must be a credit card number')
        ->and($fullMessage)->toBe('- "1234 1234 1234 1234" must be a credit card number')
        ->and($messages)->toBe(['creditCard' => '"1234 1234 1234 1234" must be a credit card number']),
));

test('failed validator with uppercase formatted input', catchAll(
    fn() => v::formatted(f::uppercase(), v::email())->assert('not an email'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"NOT AN EMAIL" must be an email address')
        ->and($fullMessage)->toBe('- "NOT AN EMAIL" must be an email address')
        ->and($messages)->toBe(['email' => '"NOT AN EMAIL" must be an email address']),
));

test('failed validator with lowercase formatted input', catchAll(
    fn() => v::formatted(f::lowercase(), v::email())->assert('NOT AN EMAIL'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"not an email" must be an email address')
        ->and($fullMessage)->toBe('- "not an email" must be an email address')
        ->and($messages)->toBe(['email' => '"not an email" must be an email address']),
));

test('failed validator with trimmed input', catchAll(
    fn() => v::formatted(f::trim('both', null), v::email())->assert('  not-email  '),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"not-email" must be an email address')
        ->and($fullMessage)->toBe('- "not-email" must be an email address')
        ->and($messages)->toBe(['email' => '"not-email" must be an email address']),
));

test('failed validator with number formatted input', catchAll(
    fn() => v::formatted(f::number(2, '.', ','), v::email())->assert('1234567.89'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1,234,567.89" must be an email address')
        ->and($fullMessage)->toBe('- "1,234,567.89" must be an email address')
        ->and($messages)->toBe(['email' => '"1,234,567.89" must be an email address']),
));

test('failed validator with date formatted input', catchAll(
    fn() => v::formatted(f::date('d/m/Y'), v::email())->assert('2024-01-15'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"15/01/2024" must be an email address')
        ->and($fullMessage)->toBe('- "15/01/2024" must be an email address')
        ->and($messages)->toBe(['email' => '"15/01/2024" must be an email address']),
));

test('failed validator with credit card formatted input', catchAll(
    fn() => v::formatted(f::creditCard(), v::creditCard())->assert('1234567890123456'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1234 5678 9012 3456" must be a credit card number')
        ->and($fullMessage)->toBe('- "1234 5678 9012 3456" must be a credit card number')
        ->and($messages)->toBe(['creditCard' => '"1234 5678 9012 3456" must be a credit card number']),
));

test('failed validator with secure credit card formatted input', catchAll(
    fn() => v::formatted(f::secureCreditCard(), v::creditCard())->assert('1234567890123456'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1234 **** **** 3456" must be a credit card number')
        ->and($fullMessage)->toBe('- "1234 **** **** 3456" must be a credit card number')
        ->and($messages)->toBe(['creditCard' => '"1234 **** **** 3456" must be a credit card number']),
));

test('failed validator with chained formatters', catchAll(
    fn() => v::formatted(f::trim('both', null)->uppercase(), v::email())->assert('  not an email  '),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"NOT AN EMAIL" must be an email address')
        ->and($fullMessage)->toBe('- "NOT AN EMAIL" must be an email address')
        ->and($messages)->toBe(['email' => '"NOT AN EMAIL" must be an email address']),
));
