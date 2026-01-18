<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
*/

declare(strict_types=1);

test('Ascending sorted template validation', catchAll(
    fn() => v::sorted('ASC')->assert([1, 3, 2]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[1, 3, 2]` must be sorted in ascending order')
        ->and($fullMessage)->toBe('- `[1, 3, 2]` must be sorted in ascending order')
        ->and($messages)->toBe(['sorted' => '`[1, 3, 2]` must be sorted in ascending order']),
));

test('Ascending sorted template validation (inverted)', catchAll(
    fn() => v::not(v::sorted('ASC'))->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[1, 2, 3]` must not be sorted in ascending order')
        ->and($fullMessage)->toBe('- `[1, 2, 3]` must not be sorted in ascending order')
        ->and($messages)->toBe(['notSorted' => '`[1, 2, 3]` must not be sorted in ascending order']),
));

test('Descending sorted template validation', catchAll(
    fn() => v::sorted('DESC')->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[1, 2, 3]` must be sorted in descending order')
        ->and($fullMessage)->toBe('- `[1, 2, 3]` must be sorted in descending order')
        ->and($messages)->toBe(['sorted' => '`[1, 2, 3]` must be sorted in descending order']),
));

test('Descending sorted template validation (inverted)', catchAll(
    fn() => v::not(v::sorted('DESC'))->assert([3, 2, 1]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[3, 2, 1]` must not be sorted in descending order')
        ->and($fullMessage)->toBe('- `[3, 2, 1]` must not be sorted in descending order')
        ->and($messages)->toBe(['notSorted' => '`[3, 2, 1]` must not be sorted in descending order']),
));
