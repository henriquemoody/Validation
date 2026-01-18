<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard UUID template validation', catchAll(
    fn() => v::uuid()->assert('g71a18f4-3a13-11e7-a919-92ebcb67fe33'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"g71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID')
        ->and($fullMessage)->toBe('- "g71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID')
        ->and($messages)->toBe(['uuid' => '"g71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID']),
));

test('Standard UUID template validation (inverted)', catchAll(
    fn() => v::not(v::uuid())->assert('fb3a7909-8034-59f5-8f38-21adbc168db7'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"fb3a7909-8034-59f5-8f38-21adbc168db7" must not be a valid UUID')
        ->and($fullMessage)->toBe('- "fb3a7909-8034-59f5-8f38-21adbc168db7" must not be a valid UUID')
        ->and($messages)->toBe(['notUuid' => '"fb3a7909-8034-59f5-8f38-21adbc168db7" must not be a valid UUID']),
));

test('Version UUID template validation', catchAll(
    fn() => v::uuid(4)->assert('a71a18f4-3a13-11e7-a919-92ebcb67fe33'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"a71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID version 4')
        ->and($fullMessage)->toBe('- "a71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID version 4')
        ->and($messages)->toBe(['uuid' => '"a71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID version 4']),
));

test('Version UUID template validation (inverted)', catchAll(
    fn() => v::not(v::uuid(4))->assert('5faf78c9-707d-4cd5-8432-ba03aa83721f'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"5faf78c9-707d-4cd5-8432-ba03aa83721f" must not be a valid UUID version 4')
        ->and($fullMessage)->toBe('- "5faf78c9-707d-4cd5-8432-ba03aa83721f" must not be a valid UUID version 4')
        ->and($messages)->toBe(['notUuid' => '"5faf78c9-707d-4cd5-8432-ba03aa83721f" must not be a valid UUID version 4']),
));
