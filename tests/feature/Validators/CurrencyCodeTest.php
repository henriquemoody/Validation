<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard currencyCode template validation', catchAll(
    fn() => v::currencyCode()->assert('ppz'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"ppz" must be a valid currency code')
        ->and($fullMessage)->toBe('- "ppz" must be a valid currency code')
        ->and($messages)->toBe(['currencyCode' => '"ppz" must be a valid currency code']),
));

test('Standard currencyCode template validation (inverted)', catchAll(
    fn() => v::not(v::currencyCode())->assert('GBP'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"GBP" must not be a valid currency code')
        ->and($fullMessage)->toBe('- "GBP" must not be a valid currency code')
        ->and($messages)->toBe(['notCurrencyCode' => '"GBP" must not be a valid currency code']),
));
