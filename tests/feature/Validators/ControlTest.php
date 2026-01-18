<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard control template validation', catchAll(
    fn() => v::control()->assert('16-50'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"16-50" must only contain control characters')
        ->and($fullMessage)->toBe('- "16-50" must only contain control characters')
        ->and($messages)->toBe(['control' => '"16-50" must only contain control characters']),
));

test('Standard control template validation (inverted)', catchAll(
    fn() => v::not(v::control())->assert("\n"),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"\\n" must not contain control characters')
        ->and($fullMessage)->toBe('- "\\n" must not contain control characters')
        ->and($messages)->toBe(['notControl' => '"\\n" must not contain control characters']),
));

test('Extra control template validation with additional characters', catchAll(
    fn() => v::control('16')->assert('16-50'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"16-50" must only contain control characters and "16"')
        ->and($fullMessage)->toBe('- "16-50" must only contain control characters and "16"')
        ->and($messages)->toBe(['control' => '"16-50" must only contain control characters and "16"']),
));

test('Extra control template validation with additional characters (inverted)', catchAll(
    fn() => v::not(v::control('16'))->assert("16\n"),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"16\\n" must not contain control characters or "16"')
        ->and($fullMessage)->toBe('- "16\\n" must not contain control characters or "16"')
        ->and($messages)->toBe(['notControl' => '"16\\n" must not contain control characters or "16"']),
));
