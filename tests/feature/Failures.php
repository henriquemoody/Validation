<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Validator::failures', function (): void {
    $failiures = v::create()
        ->key('mysql', v::create()
            ->key('host', v::stringType())
            ->key('user', v::stringType())->key('password', v::stringType())
            ->key('schema', v::stringType()))
        ->key('postgresql', v::create()
            ->key('host', v::stringType())
            ->key('user', v::stringType())
            ->key('password', v::stringType())
            ->key('schema', v::stringType()))
        ->failures(['mysql' => ['host' => 42, 'schema' => 42], 'postgresql' => ['user' => 42, 'password' => 42]]);

    expect($failiures->message)->toBe('host must be a string')
        ->and($failiures->fullMessage)->toBe(<<<'FULL_MESSAGE'
        - All of the required rules must pass for `["mysql": ["host": 42, "schema": 42], "postgresql": ["user": 42, "password": 42]]`
          - All of the required rules must pass for mysql
            - host must be a string
            - user must be present
            - password must be present
            - schema must be a string
          - All of the required rules must pass for postgresql
            - host must be present
            - user must be a string
            - password must be a string
            - schema must be present
        FULL_MESSAGE)
        ->and($failiures->messages)->toBe(
            [
                '__root__' => 'All of the required rules must pass for `["mysql": ["host": 42, "schema": 42], "postgresql": ["user": 42, "password": 42]]`',
                'mysql' => [
                    '__root__' => 'All of the required rules must pass for mysql',
                    'host' => 'host must be a string',
                    'user' => 'user must be present',
                    'password' => 'password must be present',
                    'schema' => 'schema must be a string',
                ],
                'postgresql' => [
                    '__root__' => 'All of the required rules must pass for postgresql',
                    'host' => 'host must be present',
                    'user' => 'user must be a string',
                    'password' => 'password must be a string',
                    'schema' => 'schema must be present',
                ],
            ]
        );
});
