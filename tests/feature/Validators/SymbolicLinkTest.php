<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard symbolicLink template validation', catchAll(
    fn() => v::symbolicLink()->assert('tests/fixtures/fake-filename'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/fake-filename" must be a symbolic link')
        ->and($fullMessage)->toBe('- "tests/fixtures/fake-filename" must be a symbolic link')
        ->and($messages)->toBe(['symbolicLink' => '"tests/fixtures/fake-filename" must be a symbolic link']),
));

test('Standard symbolicLink template validation (inverted)', catchAll(
    fn() => v::not(v::symbolicLink())->assert('tests/fixtures/symbolic-link'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/symbolic-link" must not be a symbolic link')
        ->and($fullMessage)->toBe('- "tests/fixtures/symbolic-link" must not be a symbolic link')
        ->and($messages)->toBe(['notSymbolicLink' => '"tests/fixtures/symbolic-link" must not be a symbolic link']),
));
