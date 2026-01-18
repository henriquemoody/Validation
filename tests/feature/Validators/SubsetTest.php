<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard subset template validation', catchAll(
    fn() => v::subset([1, 2])->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[1, 2, 3]` must be subset of `[1, 2]`')
        ->and($fullMessage)->toBe('- `[1, 2, 3]` must be subset of `[1, 2]`')
        ->and($messages)->toBe(['subset' => '`[1, 2, 3]` must be subset of `[1, 2]`']),
));

test('Standard subset template validation (inverted)', catchAll(
    fn() => v::not(v::subset([1, 2, 3]))->assert([1, 2]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[1, 2]` must not be subset of `[1, 2, 3]`')
        ->and($fullMessage)->toBe('- `[1, 2]` must not be subset of `[1, 2, 3]`')
        ->and($messages)->toBe(['notSubset' => '`[1, 2]` must not be subset of `[1, 2, 3]`']),
));
