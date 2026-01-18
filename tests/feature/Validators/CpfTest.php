<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard cpf template validation', catchAll(
    fn() => v::cpf()->assert('this thing'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"this thing" must be a valid CPF number')
        ->and($fullMessage)->toBe('- "this thing" must be a valid CPF number')
        ->and($messages)->toBe(['cpf' => '"this thing" must be a valid CPF number']),
));

test('Standard cpf template validation (inverted)', catchAll(
    fn() => v::not(v::cpf())->assert('276.865.775-11'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"276.865.775-11" must not be a valid CPF number')
        ->and($fullMessage)->toBe('- "276.865.775-11" must not be a valid CPF number')
        ->and($messages)->toBe(['notCpf' => '"276.865.775-11" must not be a valid CPF number']),
));
