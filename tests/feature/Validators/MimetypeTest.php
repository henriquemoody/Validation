<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard mimetype template validation', catchAll(
    fn() => v::mimetype('image/png')->assert('tests/fixtures/invalid-image.png'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/invalid-image.png" must have the "image/png" MIME type')
        ->and($fullMessage)->toBe('- "tests/fixtures/invalid-image.png" must have the "image/png" MIME type')
        ->and($messages)->toBe(['mimetype' => '"tests/fixtures/invalid-image.png" must have the "image/png" MIME type']),
));

test('Standard mimetype template validation (inverted)', catchAll(
    fn() => v::not(v::mimetype('image/png'))->assert('tests/fixtures/valid-image.png'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"tests/fixtures/valid-image.png" must not have the "image/png" MIME type')
        ->and($fullMessage)->toBe('- "tests/fixtures/valid-image.png" must not have the "image/png" MIME type')
        ->and($messages)->toBe(['notMimetype' => '"tests/fixtures/valid-image.png" must not have the "image/png" MIME type']),
));
