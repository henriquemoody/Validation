<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('uppercase modifier', catchMessage(
    fn() => v::templated('{{input|uppercase}} is not valid', v::email())->assert('not an email'),
    fn(string $message) => expect($message)->toBe('NOT AN EMAIL is not valid'),
));

test('lowercase modifier', catchMessage(
    fn() => v::templated('{{input|lowercase}} is not valid', v::email())->assert('NOT AN EMAIL'),
    fn(string $message) => expect($message)->toBe('not an email is not valid'),
));

test('mask modifier', catchMessage(
    fn() => v::templated('{{input|mask:1-4}} is masked', v::alwaysInvalid())->assert('secret'),
    fn(string $message) => expect($message)->toBe('****et is masked'),
));

test('mask modifier with custom replacement', catchMessage(
    fn() => v::templated('{{input|mask:1-4:X}} is masked', v::alwaysInvalid())->assert('secret'),
    fn(string $message) => expect($message)->toBe('XXXXet is masked'),
));

test('pattern modifier', catchMessage(
    fn() => v::templated('Formatted: {{input|pattern:###-####}}', v::alwaysInvalid())->assert('1234567'),
    fn(string $message) => expect($message)->toBe('Formatted: 123-4567'),
));

test('date modifier', catchMessage(
    fn() => v::templated('Date: {{input|date:d/m/Y}}', v::alwaysInvalid())->assert('2024-01-15'),
    fn(string $message) => expect($message)->toBe('Date: 15/01/2024'),
));

test('number modifier', catchMessage(
    fn() => v::templated('Value: {{input|number:2}}', v::alwaysInvalid())->assert('1234567.89'),
    fn(string $message) => expect($message)->toBe('Value: 1,234,567.89'),
));

test('creditCard modifier', catchMessage(
    fn() => v::templated('Card: {{input|creditCard}}', v::alwaysInvalid())->assert('4532015112830366'),
    fn(string $message) => expect($message)->toBe('Card: 4532 0151 1283 0366'),
));

test('secureCreditCard modifier', catchMessage(
    fn() => v::templated('Card: {{input|secureCreditCard}}', v::alwaysInvalid())->assert('4532015112830366'),
    fn(string $message) => expect($message)->toBe('Card: 4532 **** **** 0366'),
));

test('trim modifier', catchMessage(
    fn() => v::templated('{{input|trim}} is not valid', v::email())->assert('  not-email  '),
    fn(string $message) => expect($message)->toBe('not-email is not valid'),
));

test('metric modifier', catchMessage(
    fn() => v::templated('Distance: {{input|metric:mm}}', v::alwaysInvalid())->assert('5000'),
    fn(string $message) => expect($message)->toBe('Distance: 5m'),
));

test('custom parameter with modifier', catchMessage(
    fn() => v::templated('Name: {{name|uppercase}}', v::alwaysInvalid(), ['name' => 'john'])->assert(1),
    fn(string $message) => expect($message)->toBe('Name: JOHN'),
));

test('chained modifiers', catchMessage(
    fn() => v::templated('{{input|mask:1-4|uppercase}}', v::alwaysInvalid())->assert('secret'),
    fn(string $message) => expect($message)->toBe('****ET'),
));
