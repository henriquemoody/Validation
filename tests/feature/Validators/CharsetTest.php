<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard charset template validation', catchAll(
    fn() => v::charset('ASCII')->assert('açaí'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"açaí" must only contain characters from the `["ASCII"]` charset')
        ->and($fullMessage)->toBe('- "açaí" must only contain characters from the `["ASCII"]` charset')
        ->and($messages)->toBe(['charset' => '"açaí" must only contain characters from the `["ASCII"]` charset']),
));

test('Standard charset template validation (inverted)', catchAll(
    fn() => v::not(v::charset('UTF-8'))->assert('açaí'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"açaí" must not contain any characters from the `["UTF-8"]` charset')
        ->and($fullMessage)->toBe('- "açaí" must not contain any characters from the `["UTF-8"]` charset')
        ->and($messages)->toBe(['notCharset' => '"açaí" must not contain any characters from the `["UTF-8"]` charset']),
));
