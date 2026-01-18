<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Standard polishIdCard template validation', catchAll(
    fn() => v::polishIdCard()->assert('AYE205411'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"AYE205411" must be a valid Polish Identity Card number')
        ->and($fullMessage)->toBe('- "AYE205411" must be a valid Polish Identity Card number')
        ->and($messages)->toBe(['polishIdCard' => '"AYE205411" must be a valid Polish Identity Card number']),
));

test('Standard polishIdCard template validation (inverted)', catchAll(
    fn() => v::not(v::polishIdCard())->assert('AYE205410'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"AYE205410" must not be a valid Polish Identity Card number')
        ->and($fullMessage)->toBe('- "AYE205410" must not be a valid Polish Identity Card number')
        ->and($messages)->toBe(['notPolishIdCard' => '"AYE205410" must not be a valid Polish Identity Card number']),
));
