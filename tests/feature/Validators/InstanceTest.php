<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard instance template validation', catchAll(
    fn() => v::instance(DateTime::class)->assert(''),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"" must be an instance of `DateTime`')
        ->and($fullMessage)->toBe('- "" must be an instance of `DateTime`')
        ->and($messages)->toBe(['instance' => '"" must be an instance of `DateTime`']),
));

test('Standard instance template validation (inverted)', catchAll(
    fn() => v::not(v::instance(Traversable::class))->assert(new ArrayObject()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`ArrayObject { getArrayCopy() => [] }` must not be an instance of `Traversable`')
        ->and($fullMessage)->toBe('- `ArrayObject { getArrayCopy() => [] }` must not be an instance of `Traversable`')
        ->and($messages)->toBe(['notInstance' => '`ArrayObject { getArrayCopy() => [] }` must not be an instance of `Traversable`']),
));
