<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Standard nip template validation', catchAll(
    fn() => v::nip()->assert('1645865778'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1645865778" must be a valid Polish VAT identification number')
        ->and($fullMessage)->toBe('- "1645865778" must be a valid Polish VAT identification number')
        ->and($messages)->toBe(['nip' => '"1645865778" must be a valid Polish VAT identification number']),
));

test('Standard nip template validation (inverted)', catchAll(
    fn() => v::not(v::nip())->assert('1645865777'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1645865777" must not be a valid Polish VAT identification number')
        ->and($fullMessage)->toBe('- "1645865777" must not be a valid Polish VAT identification number')
        ->and($messages)->toBe(['notNip' => '"1645865777" must not be a valid Polish VAT identification number']),
));
