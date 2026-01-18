<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('FalseVal default template with boolean true input', catchAll(
    fn() => v::falseVal()->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must evaluate to `false`')
        ->and($fullMessage)->toBe('- `true` must evaluate to `false`')
        ->and($messages)->toBe(['falseVal' => '`true` must evaluate to `false`']),
));

test('FalseVal default template with negative assertion', catchAll(
    fn() => v::not(v::falseVal())->assert('false'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"false" must not evaluate to `false`')
        ->and($fullMessage)->toBe('- "false" must not evaluate to `false`')
        ->and($messages)->toBe(['notFalseVal' => '"false" must not evaluate to `false`']),
));

test('FalseVal default template with numeric input', catchAll(
    fn() => v::falseVal()->assert(1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1 must evaluate to `false`')
        ->and($fullMessage)->toBe('- 1 must evaluate to `false`')
        ->and($messages)->toBe(['falseVal' => '1 must evaluate to `false`']),
));
