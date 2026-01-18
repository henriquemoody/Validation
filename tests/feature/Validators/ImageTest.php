<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard image template validation', catchAll(
    fn() => v::image()->assert('tests/fixtures/invalid-image.png'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/invalid-image.png" must be a valid image file')
        ->and($fullMessage)->toBe('- "tests/fixtures/invalid-image.png" must be a valid image file')
        ->and($messages)->toBe(['image' => '"tests/fixtures/invalid-image.png" must be a valid image file']),
));

test('Standard image template validation (inverted)', catchAll(
    fn() => v::not(v::image())->assert('tests/fixtures/valid-image.png'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/valid-image.png" must not be a valid image file')
        ->and($fullMessage)->toBe('- "tests/fixtures/valid-image.png" must not be a valid image file')
        ->and($messages)->toBe(['notImage' => '"tests/fixtures/valid-image.png" must not be a valid image file']),
));
