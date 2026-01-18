<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Invalid public domain suffix template validation', catchAll(
    fn() => v::publicDomainSuffix()->assert('invalid-domain'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"invalid-domain" must be a public domain suffix')
        ->and($fullMessage)->toBe('- "invalid-domain" must be a public domain suffix')
        ->and($messages)->toBe(['publicDomainSuffix' => '"invalid-domain" must be a public domain suffix']),
));

test('Invalid public domain suffix template validation with array', catchAll(
    fn() => v::publicDomainSuffix()->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[]` must be a public domain suffix')
        ->and($fullMessage)->toBe('- `[]` must be a public domain suffix')
        ->and($messages)->toBe(['publicDomainSuffix' => '`[]` must be a public domain suffix']),
));

test('Valid public domain suffix template validation (inverted)', catchAll(
    fn() => v::not(v::publicDomainSuffix())->assert('co.uk'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"co.uk" must not be a public domain suffix')
        ->and($fullMessage)->toBe('- "co.uk" must not be a public domain suffix')
        ->and($messages)->toBe(['notPublicDomainSuffix' => '"co.uk" must not be a public domain suffix']),
));

test('Valid public domain suffix template validation with TLD (inverted)', catchAll(
    fn() => v::not(v::publicDomainSuffix())->assert('nom.br'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"nom.br" must not be a public domain suffix')
        ->and($fullMessage)->toBe('- "nom.br" must not be a public domain suffix')
        ->and($messages)->toBe(['notPublicDomainSuffix' => '"nom.br" must not be a public domain suffix']),
));
