<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard file template validation', catchAll(
    fn() => v::file()->assert('tests/fixtures/non-existent.sh'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/non-existent.sh" must be a valid file')
        ->and($fullMessage)->toBe('- "tests/fixtures/non-existent.sh" must be a valid file')
        ->and($messages)->toBe(['file' => '"tests/fixtures/non-existent.sh" must be a valid file']),
));

test('Standard file template validation (inverted)', catchAll(
    fn() => v::not(v::file())->assert('tests/fixtures/valid-image.png'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/valid-image.png" must be an invalid file')
        ->and($fullMessage)->toBe('- "tests/fixtures/valid-image.png" must be an invalid file')
        ->and($messages)->toBe(['notFile' => '"tests/fixtures/valid-image.png" must be an invalid file']),
));
