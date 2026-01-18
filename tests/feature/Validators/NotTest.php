<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Not validator with alpha - should invert template', catchAll(
    fn() => v::not(v::alpha())->assert('validAlpha'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"validAlpha" must not contain letters (a-z)')
        ->and($fullMessage)->toBe('- "validAlpha" must not contain letters (a-z)')
        ->and($messages)->toBe(['notAlpha' => '"validAlpha" must not contain letters (a-z)']),
));

test('Not validator with numericVal - should invert template', catchAll(
    fn() => v::not(v::numericVal())->assert('123'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"123" must not be a numeric value')
        ->and($fullMessage)->toBe('- "123" must not be a numeric value')
        ->and($messages)->toBe(['notNumericVal' => '"123" must not be a numeric value']),
));

test('Not validator with phpLabel - should invert template', catchAll(
    fn() => v::not(v::phpLabel())->assert('valid_label'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"valid_label" must not be a valid PHP label')
        ->and($fullMessage)->toBe('- "valid_label" must not be a valid PHP label')
        ->and($messages)->toBe(['notPhpLabel' => '"valid_label" must not be a valid PHP label']),
));

test('Not validator with portugueseNif - should invert template', catchAll(
    fn() => v::not(v::portugueseNif())->assert('124885446'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"124885446" must not be a Portuguese NIF')
        ->and($fullMessage)->toBe('- "124885446" must not be a Portuguese NIF')
        ->and($messages)->toBe(['notPortugueseNif' => '"124885446" must not be a Portuguese NIF']),
));
