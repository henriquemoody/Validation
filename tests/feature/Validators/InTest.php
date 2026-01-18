<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('In default template with numeric array and strict mode', catchAll(
    fn() => v::in([3, 2])->assert(1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1 must be in `[3, 2]`')
        ->and($fullMessage)->toBe('- 1 must be in `[3, 2]`')
        ->and($messages)->toBe(['in' => '1 must be in `[3, 2]`']),
));

test('In default template with string source and negative assertion', catchAll(
    fn() => v::not(v::in('foobar'))->assert('foo'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"foo" must not be in "foobar"')
        ->and($fullMessage)->toBe('- "foo" must not be in "foobar"')
        ->and($messages)->toBe(['notIn' => '"foo" must not be in "foobar"']),
));

test('In default template with mixed array and strict comparison', catchAll(
    fn() => v::in([2, '1', 3], true)->assert('2'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"2" must be in `[2, "1", 3]`')
        ->and($fullMessage)->toBe('- "2" must be in `[2, "1", 3]`')
        ->and($messages)->toBe(['in' => '"2" must be in `[2, "1", 3]`']),
));
