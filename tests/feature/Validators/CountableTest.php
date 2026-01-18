<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard countable template validation', catchAll(
    fn() => v::countable()->assert('Not countable!'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"Not countable!" must be a countable value')
        ->and($fullMessage)->toBe('- "Not countable!" must be a countable value')
        ->and($messages)->toBe(['countable' => '"Not countable!" must be a countable value']),
));

test('Standard countable template validation (inverted)', catchAll(
    fn() => v::not(v::countable())->assert(new ArrayObject()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`ArrayObject { getArrayCopy() => [] }` must not be a countable value')
        ->and($fullMessage)->toBe('- `ArrayObject { getArrayCopy() => [] }` must not be a countable value')
        ->and($messages)->toBe(['notCountable' => '`ArrayObject { getArrayCopy() => [] }` must not be a countable value']),
));
