<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard regex template validation', catchAll(
    fn() => v::regex('/^w+$/')->assert('w poiur'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"w poiur" must match the pattern `/^w+$/`')
        ->and($fullMessage)->toBe('- "w poiur" must match the pattern `/^w+$/`')
        ->and($messages)->toBe(['regex' => '"w poiur" must match the pattern `/^w+$/`']),
));

test('Standard regex template validation (inverted)', catchAll(
    fn() => v::not(v::regex('/^[a-z]+$/'))->assert('wpoiur'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"wpoiur" must not match the pattern `/^[a-z]+$/`')
        ->and($fullMessage)->toBe('- "wpoiur" must not match the pattern `/^[a-z]+$/`')
        ->and($messages)->toBe(['notRegex' => '"wpoiur" must not match the pattern `/^[a-z]+$/`']),
));
