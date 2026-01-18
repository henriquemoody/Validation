<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard uploaded template validation', catchAll(
    function (): void {
        set_mock_is_uploaded_file_return(false);
        v::uploaded()->assert('filename');
    },
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"filename" must be an uploaded file')
        ->and($fullMessage)->toBe('- "filename" must be an uploaded file')
        ->and($messages)->toBe(['uploaded' => '"filename" must be an uploaded file']),
));

test('Standard uploaded template validation (inverted)', catchAll(
    function (): void {
        set_mock_is_uploaded_file_return(true);
        v::not(v::uploaded())->assert('filename');
    },
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"filename" must not be an uploaded file')
        ->and($fullMessage)->toBe('- "filename" must not be an uploaded file')
        ->and($messages)->toBe(['notUploaded' => '"filename" must not be an uploaded file']),
));
