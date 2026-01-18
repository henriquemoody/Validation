<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard postalCode template validation', catchAll(
    fn() => v::postalCode('BR')->assert('1057BV'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1057BV" must be a valid postal code on "BR"')
        ->and($fullMessage)->toBe('- "1057BV" must be a valid postal code on "BR"')
        ->and($messages)->toBe(['postalCode' => '"1057BV" must be a valid postal code on "BR"']),
));

test('Standard postalCode template validation (inverted)', catchAll(
    fn() => v::not(v::postalCode('NL'))->assert('1057BV'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1057BV" must not be a valid postal code on "NL"')
        ->and($fullMessage)->toBe('- "1057BV" must not be a valid postal code on "NL"')
        ->and($messages)->toBe(['notPostalCode' => '"1057BV" must not be a valid postal code on "NL"']),
));
