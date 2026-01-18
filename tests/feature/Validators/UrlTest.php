<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('URL default template with invalid domain', catchAll(
    fn() => v::url()->assert('example.com'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"example.com" must be a URL')
        ->and($fullMessage)->toBe('- "example.com" must be a URL')
        ->and($messages)->toBe(['url' => '"example.com" must be a URL']),
));

test('URL default template with negative assertion', catchAll(
    fn() => v::not(v::url())->assert('http://example.com'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"http://example.com" must not be a URL')
        ->and($fullMessage)->toBe('- "http://example.com" must not be a URL')
        ->and($messages)->toBe(['notUrl' => '"http://example.com" must not be a URL']),
));
