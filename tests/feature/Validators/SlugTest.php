<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard slug template validation', catchAll(
    fn() => v::slug()->assert('my-Slug'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"my-Slug" must be a valid slug')
        ->and($fullMessage)->toBe('- "my-Slug" must be a valid slug')
        ->and($messages)->toBe(['slug' => '"my-Slug" must be a valid slug']),
));

test('Standard slug template validation (inverted)', catchAll(
    fn() => v::not(v::slug())->assert('my-slug'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"my-slug" must not be a valid slug')
        ->and($fullMessage)->toBe('- "my-slug" must not be a valid slug')
        ->and($messages)->toBe(['notSlug' => '"my-slug" must not be a valid slug']),
));
