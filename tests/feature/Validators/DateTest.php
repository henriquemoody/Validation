<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Standard date template validation', catchAll(
    fn() => v::date()->assert('2018-01-29T08:32:54+00:00'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"')
        ->and($fullMessage)->toBe('- "2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"')
        ->and($messages)->toBe(['date' => '"2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"']),
));

test('Standard date template validation (inverted)', catchAll(
    fn() => v::not(v::date())->assert('2018-01-29'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"2018-01-29" must not be a valid date in the format "2005-12-30"')
        ->and($fullMessage)->toBe('- "2018-01-29" must not be a valid date in the format "2005-12-30"')
        ->and($messages)->toBe(['notDate' => '"2018-01-29" must not be a valid date in the format "2005-12-30"']),
));
