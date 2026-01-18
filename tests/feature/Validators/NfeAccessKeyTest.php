<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Standard nfeAccessKey template validation', catchAll(
    fn() => v::nfeAccessKey()->assert('31841136830118868211870485416765268625116906'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"31841136830118868211870485416765268625116906" must be a valid NFe access key')
        ->and($fullMessage)->toBe('- "31841136830118868211870485416765268625116906" must be a valid NFe access key')
        ->and($messages)->toBe(['nfeAccessKey' => '"31841136830118868211870485416765268625116906" must be a valid NFe access key']),
));

test('Standard nfeAccessKey template validation (inverted)', catchAll(
    fn() => v::not(v::nfeAccessKey())->assert('52060433009911002506550120000007800267301615'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"52060433009911002506550120000007800267301615" must not be a valid NFe access key')
        ->and($fullMessage)->toBe('- "52060433009911002506550120000007800267301615" must not be a valid NFe access key')
        ->and($messages)->toBe(['notNfeAccessKey' => '"52060433009911002506550120000007800267301615" must not be a valid NFe access key']),
));
