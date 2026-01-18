<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard readable template validation', catchAll(
    fn() => v::readable()->assert('tests/fixtures/invalid-image.jpg'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/invalid-image.jpg" must be readable')
        ->and($fullMessage)->toBe('- "tests/fixtures/invalid-image.jpg" must be readable')
        ->and($messages)->toBe(['readable' => '"tests/fixtures/invalid-image.jpg" must be readable']),
));

test('Standard readable template validation (inverted)', catchAll(
    fn() => v::not(v::readable())->assert('tests/fixtures/valid-image.png'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/valid-image.png" must not be readable')
        ->and($fullMessage)->toBe('- "tests/fixtures/valid-image.png" must not be readable')
        ->and($messages)->toBe(['notReadable' => '"tests/fixtures/valid-image.png" must not be readable']),
));
