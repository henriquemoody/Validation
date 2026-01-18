<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\ValidationException;

function catchAll(Closure $try, Closure $catch): Closure
{
    return function () use ($try, $catch): void {
        try {
            $try->call($this);
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            $catch->call($this, $e->getMessage(), $e->getFullMessage(), $e->getMessages());
        }
    };
}

function catchMessage(Closure $try, Closure $catch): Closure
{
    return function () use ($try, $catch): void {
        try {
            $try->call($this);
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            $catch->call($this, $e->getMessage());
        }
    };
}

function catchFullMessage(Closure $try, Closure $catch): Closure
{
    return function () use ($try, $catch): void {
        try {
            $try->call($this);
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            $catch->call($this, $e->getFullMessage());
        }
    };
}

function catchMessages(Closure $try, Closure $catch): Closure
{
    return function () use ($try, $catch): void {
        try {
            $try->call($this);
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            $catch->call($this, $e->getMessages());
        }
    };
}
