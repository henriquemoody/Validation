<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Unique default template with duplicate array', catchAll(
    fn() => v::unique()->assert([1, 2, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[1, 2, 2, 3]` must not contain duplicates')
        ->and($fullMessage)->toBe('- `[1, 2, 2, 3]` must not contain duplicates')
        ->and($messages)->toBe(['unique' => '`[1, 2, 2, 3]` must not contain duplicates']),
));

test('Unique default template with negative assertion', catchAll(
    fn() => v::not(v::unique())->assert([1, 2, 3, 4]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[1, 2, 3, 4]` must contain duplicates')
        ->and($fullMessage)->toBe('- `[1, 2, 3, 4]` must contain duplicates')
        ->and($messages)->toBe(['notUnique' => '`[1, 2, 3, 4]` must contain duplicates']),
));

test('Unique default template with string input', catchAll(
    fn() => v::unique()->assert('test'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"test" must not contain duplicates')
        ->and($fullMessage)->toBe('- "test" must not contain duplicates')
        ->and($messages)->toBe(['unique' => '"test" must not contain duplicates']),
));
