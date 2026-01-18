<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard equivalent template validation', catchAll(
    fn() => v::equivalent(true)->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`false` must be equivalent to `true`')
        ->and($fullMessage)->toBe('- `false` must be equivalent to `true`')
        ->and($messages)->toBe(['equivalent' => '`false` must be equivalent to `true`']),
));

test('Standard equivalent template validation (inverted)', catchAll(
    fn() => v::not(v::equivalent('Something'))->assert('someThing'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"someThing" must not be equivalent to "Something"')
        ->and($fullMessage)->toBe('- "someThing" must not be equivalent to "Something"')
        ->and($messages)->toBe(['notEquivalent' => '"someThing" must not be equivalent to "Something"']),
));
