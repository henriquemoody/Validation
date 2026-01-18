<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard languageCode template validation', catchAll(
    fn() => v::languageCode()->assert('por'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"por" must be a valid language code')
        ->and($fullMessage)->toBe('- "por" must be a valid language code')
        ->and($messages)->toBe(['languageCode' => '"por" must be a valid language code']),
));

test('Standard languageCode template validation (inverted)', catchAll(
    fn() => v::not(v::languageCode())->assert('en'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"en" must not be a valid language code')
        ->and($fullMessage)->toBe('- "en" must not be a valid language code')
        ->and($messages)->toBe(['notLanguageCode' => '"en" must not be a valid language code']),
));
