<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard tld template validation', catchAll(
    fn() => v::tld()->assert('42'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"42" must be a valid top-level domain name')
        ->and($fullMessage)->toBe('- "42" must be a valid top-level domain name')
        ->and($messages)->toBe(['tld' => '"42" must be a valid top-level domain name']),
));

test('Standard tld template validation (inverted)', catchAll(
    fn() => v::not(v::tld())->assert('com'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"com" must not be a valid top-level domain name')
        ->and($fullMessage)->toBe('- "com" must not be a valid top-level domain name')
        ->and($messages)->toBe(['notTld' => '"com" must not be a valid top-level domain name']),
));
