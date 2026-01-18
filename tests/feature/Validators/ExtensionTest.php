<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard extension template validation', catchAll(
    fn() => v::extension('png')->assert('filename.txt'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"filename.txt" must have "png" extension')
        ->and($fullMessage)->toBe('- "filename.txt" must have "png" extension')
        ->and($messages)->toBe(['extension' => '"filename.txt" must have "png" extension']),
));

test('Standard extension template validation (inverted)', catchAll(
    fn() => v::not(v::extension('gif'))->assert('filename.gif'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"filename.gif" must not have "gif" extension')
        ->and($fullMessage)->toBe('- "filename.gif" must not have "gif" extension')
        ->and($messages)->toBe(['notExtension' => '"filename.gif" must not have "gif" extension']),
));
