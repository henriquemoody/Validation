<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard imei template validation', catchAll(
    fn() => v::imei()->assert('490154203237512'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"490154203237512" must be a valid IMEI number')
        ->and($fullMessage)->toBe('- "490154203237512" must be a valid IMEI number')
        ->and($messages)->toBe(['imei' => '"490154203237512" must be a valid IMEI number']),
));

test('Standard imei template validation (inverted)', catchAll(
    fn() => v::not(v::imei())->assert('350077523237513'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"350077523237513" must not be a valid IMEI number')
        ->and($fullMessage)->toBe('- "350077523237513" must not be a valid IMEI number')
        ->and($messages)->toBe(['notImei' => '"350077523237513" must not be a valid IMEI number']),
));
