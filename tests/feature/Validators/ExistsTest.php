<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard exists template validation', catchAll(
    fn() => v::exists()->assert('/path/of/a/non-existent/file'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"/path/of/a/non-existent/file" must be an existing file')
        ->and($fullMessage)->toBe('- "/path/of/a/non-existent/file" must be an existing file')
        ->and($messages)->toBe(['exists' => '"/path/of/a/non-existent/file" must be an existing file']),
));

test('Standard exists template validation (inverted)', catchAll(
    fn() => v::not(v::exists())->assert('tests/fixtures/valid-image.gif'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/valid-image.gif" must not be an existing file')
        ->and($fullMessage)->toBe('- "tests/fixtures/valid-image.gif" must not be an existing file')
        ->and($messages)->toBe(['notExists' => '"tests/fixtures/valid-image.gif" must not be an existing file']),
));
