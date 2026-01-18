<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard nif template validation', catchAll(
    fn() => v::nif()->assert('06357771Q'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"06357771Q" must be a valid NIF')
        ->and($fullMessage)->toBe('- "06357771Q" must be a valid NIF')
        ->and($messages)->toBe(['nif' => '"06357771Q" must be a valid NIF']),
));

test('Standard nif template validation (inverted)', catchAll(
    fn() => v::not(v::nif())->assert('71110316C'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"71110316C" must not be a valid NIF')
        ->and($fullMessage)->toBe('- "71110316C" must not be a valid NIF')
        ->and($messages)->toBe(['notNif' => '"71110316C" must not be a valid NIF']),
));
