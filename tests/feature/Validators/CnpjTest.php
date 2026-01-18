<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Standard cnpj template validation', catchAll(
    fn() => v::cnpj()->assert('test'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"test" must be a valid CNPJ number')
        ->and($fullMessage)->toBe('- "test" must be a valid CNPJ number')
        ->and($messages)->toBe(['cnpj' => '"test" must be a valid CNPJ number']),
));

test('Standard cnpj template validation (inverted)', catchAll(
    fn() => v::not(v::cnpj())->assert('65.150.175/0001-20'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"65.150.175/0001-20" must not be a valid CNPJ number')
        ->and($fullMessage)->toBe('- "65.150.175/0001-20" must not be a valid CNPJ number')
        ->and($messages)->toBe(['notCnpj' => '"65.150.175/0001-20" must not be a valid CNPJ number']),
));
