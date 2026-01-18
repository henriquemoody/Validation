<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Invalid PHP label template validation', catchAll(
    fn() => v::phpLabel()->assert('123invalid'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"123invalid" must be a valid PHP label')
        ->and($fullMessage)->toBe('- "123invalid" must be a valid PHP label')
        ->and($messages)->toBe(['phpLabel' => '"123invalid" must be a valid PHP label']),
));

test('Invalid PHP label template validation with array', catchAll(
    fn() => v::phpLabel()->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[]` must be a valid PHP label')
        ->and($fullMessage)->toBe('- `[]` must be a valid PHP label')
        ->and($messages)->toBe(['phpLabel' => '`[]` must be a valid PHP label']),
));

test('Valid PHP label template validation (inverted)', catchAll(
    fn() => v::not(v::phpLabel())->assert('validLabel'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"validLabel" must not be a valid PHP label')
        ->and($fullMessage)->toBe('- "validLabel" must not be a valid PHP label')
        ->and($messages)->toBe(['notPhpLabel' => '"validLabel" must not be a valid PHP label']),
));

test('Valid PHP label template validation with underscore (inverted)', catchAll(
    fn() => v::not(v::phpLabel())->assert('_valid_label'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"_valid_label" must not be a valid PHP label')
        ->and($fullMessage)->toBe('- "_valid_label" must not be a valid PHP label')
        ->and($messages)->toBe(['notPhpLabel' => '"_valid_label" must not be a valid PHP label']),
));
