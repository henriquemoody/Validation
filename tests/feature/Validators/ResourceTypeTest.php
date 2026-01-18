<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard resourceType template validation', catchAll(
    fn() => v::resourceType()->assert('test'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"test" must be a resource')
        ->and($fullMessage)->toBe('- "test" must be a resource')
        ->and($messages)->toBe(['resourceType' => '"test" must be a resource']),
));

test('Standard resourceType template validation (inverted)', catchAll(
    fn() => v::not(v::resourceType())->assert(tmpfile()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`resource <stream>` must not be a resource')
        ->and($fullMessage)->toBe('- `resource <stream>` must not be a resource')
        ->and($messages)->toBe(['notResourceType' => '`resource <stream>` must not be a resource']),
));
