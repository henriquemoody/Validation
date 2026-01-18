<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard base template validation with base 61', catchAll(
    fn() => v::base(61)->assert('Z01xSsg5675hic20dj'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"Z01xSsg5675hic20dj" must be a number in base 61')
        ->and($fullMessage)->toBe('- "Z01xSsg5675hic20dj" must be a number in base 61')
        ->and($messages)->toBe(['base' => '"Z01xSsg5675hic20dj" must be a number in base 61']),
));

test('Standard base template validation with base 2', catchAll(
    fn() => v::base(2)->assert(''),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"" must be a number in base 2')
        ->and($fullMessage)->toBe('- "" must be a number in base 2')
        ->and($messages)->toBe(['base' => '"" must be a number in base 2']),
));

test('Standard base template validation (inverted)', catchAll(
    fn() => v::not(v::base(2))->assert('011010001'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"011010001" must not be a number in base 2')
        ->and($fullMessage)->toBe('- "011010001" must not be a number in base 2')
        ->and($messages)->toBe(['notBase' => '"011010001" must not be a number in base 2']),
));
