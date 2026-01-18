<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard writable template validation', catchAll(
    fn() => v::writable()->assert('/path/of/a/valid/writable/file.txt'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"/path/of/a/valid/writable/file.txt" must be writable')
        ->and($fullMessage)->toBe('- "/path/of/a/valid/writable/file.txt" must be writable')
        ->and($messages)->toBe(['writable' => '"/path/of/a/valid/writable/file.txt" must be writable']),
));

test('Standard writable template validation (inverted)', catchAll(
    fn() => v::not(v::writable())->assert('tests/fixtures/valid-image.png'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/valid-image.png" must not be writable')
        ->and($fullMessage)->toBe('- "tests/fixtures/valid-image.png" must not be writable')
        ->and($messages)->toBe(['notWritable' => '"tests/fixtures/valid-image.png" must not be writable']),
));
