<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard iban template validation', catchAll(
    fn() => v::iban()->assert('NOT AN IBAN'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"NOT AN IBAN" must be a valid IBAN')
        ->and($fullMessage)->toBe('- "NOT AN IBAN" must be a valid IBAN')
        ->and($messages)->toBe(['iban' => '"NOT AN IBAN" must be a valid IBAN']),
));

test('Standard iban template validation (inverted)', catchAll(
    fn() => v::not(v::iban())->assert('HU93 1160 0006 0000 0000 1234 5676'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"HU93 1160 0006 0000 0000 1234 5676" must not be a valid IBAN')
        ->and($fullMessage)->toBe('- "HU93 1160 0006 0000 0000 1234 5676" must not be a valid IBAN')
        ->and($messages)->toBe(['notIban' => '"HU93 1160 0006 0000 0000 1234 5676" must not be a valid IBAN']),
));
