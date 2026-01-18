<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
*/

declare(strict_types=1);

test('Standard video URL template validation', catchAll(
    fn() => v::videoUrl()->assert('example.com'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"example.com" must be a valid video URL')
        ->and($fullMessage)->toBe('- "example.com" must be a valid video URL')
        ->and($messages)->toBe(['videoUrl' => '"example.com" must be a valid video URL']),
));

test('Standard video URL template validation (inverted)', catchAll(
    fn() => v::not(v::videoUrl())->assert('https://player.vimeo.com/video/7178746722'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"https://player.vimeo.com/video/7178746722" must not be a valid video URL')
        ->and($fullMessage)->toBe('- "https://player.vimeo.com/video/7178746722" must not be a valid video URL')
        ->and($messages)->toBe(['notVideoUrl' => '"https://player.vimeo.com/video/7178746722" must not be a valid video URL']),
));

test('Service-specific video URL template validation', catchAll(
    fn() => v::videoUrl('YouTube')->assert('example.com'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"example.com" must be a valid YouTube video URL')
        ->and($fullMessage)->toBe('- "example.com" must be a valid YouTube video URL')
        ->and($messages)->toBe(['videoUrl' => '"example.com" must be a valid YouTube video URL']),
));

test('Service-specific video URL template validation (inverted)', catchAll(
    fn() => v::not(v::videoUrl('Vimeo'))->assert('https://vimeo.com/71787467'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"https://vimeo.com/71787467" must not be a valid Vimeo video URL')
        ->and($fullMessage)->toBe('- "https://vimeo.com/71787467" must not be a valid Vimeo video URL')
        ->and($messages)->toBe(['notVideoUrl' => '"https://vimeo.com/71787467" must not be a valid Vimeo video URL']),
));
