<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('CountryCode default template with positive assertion', catchAll(
    fn() => v::countryCode()->assert('1'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1" must be a valid country code')
        ->and($fullMessage)->toBe('- "1" must be a valid country code')
        ->and($messages)->toBe(['countryCode' => '"1" must be a valid country code']),
));

test('CountryCode default template with negative assertion', catchAll(
    fn() => v::not(v::countryCode())->assert('BR'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"BR" must not be a valid country code')
        ->and($fullMessage)->toBe('- "BR" must not be a valid country code')
        ->and($messages)->toBe(['notCountryCode' => '"BR" must not be a valid country code']),
));
