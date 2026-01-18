<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard contains template validation', catchAll(
    fn() => v::contains('foo')->assert('bar'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"bar" must contain "foo"')
        ->and($fullMessage)->toBe('- "bar" must contain "foo"')
        ->and($messages)->toBe(['contains' => '"bar" must contain "foo"']),
));

test('Standard contains template validation (inverted)', catchAll(
    fn() => v::not(v::contains('foo'))->assert('fool'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"fool" must not contain "foo"')
        ->and($fullMessage)->toBe('- "fool" must not contain "foo"')
        ->and($messages)->toBe(['notContains' => '"fool" must not contain "foo"']),
));
