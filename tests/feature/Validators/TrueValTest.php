<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard trueVal template validation', catchAll(
    fn() => v::trueVal()->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`false` must evaluate to `true`')
        ->and($fullMessage)->toBe('- `false` must evaluate to `true`')
        ->and($messages)->toBe(['trueVal' => '`false` must evaluate to `true`']),
));

test('Standard trueVal template validation (inverted)', catchAll(
    fn() => v::not(v::trueVal())->assert(1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1 must not evaluate to `true`')
        ->and($fullMessage)->toBe('- 1 must not evaluate to `true`')
        ->and($messages)->toBe(['notTrueVal' => '1 must not evaluate to `true`']),
));
