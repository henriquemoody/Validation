<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard pis template validation', catchAll(
    fn() => v::pis()->assert('this thing'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"this thing" must be a valid PIS number')
        ->and($fullMessage)->toBe('- "this thing" must be a valid PIS number')
        ->and($messages)->toBe(['pis' => '"this thing" must be a valid PIS number']),
));

test('Standard pis template validation (inverted)', catchAll(
    fn() => v::not(v::pis())->assert('120.6671.406-4'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"120.6671.406-4" must not be a valid PIS number')
        ->and($fullMessage)->toBe('- "120.6671.406-4" must not be a valid PIS number')
        ->and($messages)->toBe(['notPis' => '"120.6671.406-4" must not be a valid PIS number']),
));
