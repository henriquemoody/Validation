<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard hexRgbColor template validation', catchAll(
    fn() => v::hexRgbColor()->assert('invalid'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"invalid" must be a hex RGB color')
        ->and($fullMessage)->toBe('- "invalid" must be a hex RGB color')
        ->and($messages)->toBe(['hexRgbColor' => '"invalid" must be a hex RGB color']),
));

test('Standard hexRgbColor template validation (inverted)', catchAll(
    fn() => v::not(v::hexRgbColor())->assert('#808080'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"#808080" must not be a hex RGB color')
        ->and($fullMessage)->toBe('- "#808080" must not be a hex RGB color')
        ->and($messages)->toBe(['notHexRgbColor' => '"#808080" must not be a hex RGB color']),
));
