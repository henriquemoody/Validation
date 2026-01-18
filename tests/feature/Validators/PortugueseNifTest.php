<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Invalid Portuguese NIF template validation', catchAll(
    fn() => v::portugueseNif()->assert('429468882'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"429468882" must be a Portuguese NIF')
        ->and($fullMessage)->toBe('- "429468882" must be a Portuguese NIF')
        ->and($messages)->toBe(['portugueseNif' => '"429468882" must be a Portuguese NIF']),
));

test('Invalid Portuguese NIF template validation with wrong format', catchAll(
    fn() => v::portugueseNif()->assert('ABC456789'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"ABC456789" must be a Portuguese NIF')
        ->and($fullMessage)->toBe('- "ABC456789" must be a Portuguese NIF')
        ->and($messages)->toBe(['portugueseNif' => '"ABC456789" must be a Portuguese NIF']),
));

test('Valid Portuguese NIF template validation (inverted)', catchAll(
    fn() => v::not(v::portugueseNif())->assert('124885446'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"124885446" must not be a Portuguese NIF')
        ->and($fullMessage)->toBe('- "124885446" must not be a Portuguese NIF')
        ->and($messages)->toBe(['notPortugueseNif' => '"124885446" must not be a Portuguese NIF']),
));

test('Valid Portuguese NIF template validation with another valid format (inverted)', catchAll(
    fn() => v::not(v::portugueseNif())->assert('296981079'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"296981079" must not be a Portuguese NIF')
        ->and($fullMessage)->toBe('- "296981079" must not be a Portuguese NIF')
        ->and($messages)->toBe(['notPortugueseNif' => '"296981079" must not be a Portuguese NIF']),
));
