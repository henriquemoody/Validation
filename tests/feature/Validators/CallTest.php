<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard call template validation', catchAll(
    fn() => v::call('trim', v::notSpaced())->assert(' two words '),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"two words" must not contain whitespaces')
        ->and($fullMessage)->toBe('- "two words" must not contain whitespaces')
        ->and($messages)->toBe(['notSpaced' => '"two words" must not contain whitespaces']),
));

test('Standard call template validation (inverted)', catchAll(
    fn() => v::not(v::call('stripslashes', v::stringType()))->assert(' some\thing '),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('" something " must not be a string')
        ->and($fullMessage)->toBe('- " something " must not be a string')
        ->and($messages)->toBe(['notStringType' => '" something " must not be a string']),
));
