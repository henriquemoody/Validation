<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard bsn template validation', catchAll(
    fn() => v::bsn()->assert('abc'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"abc" must be a valid BSN')
        ->and($fullMessage)->toBe('- "abc" must be a valid BSN')
        ->and($messages)->toBe(['bsn' => '"abc" must be a valid BSN']),
));

test('Standard bsn template validation (inverted)', catchAll(
    fn() => v::not(v::bsn())->assert('612890053'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"612890053" must not be a valid BSN')
        ->and($fullMessage)->toBe('- "612890053" must not be a valid BSN')
        ->and($messages)->toBe(['notBsn' => '"612890053" must not be a valid BSN']),
));
