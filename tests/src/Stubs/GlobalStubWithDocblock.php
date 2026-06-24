<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

// This class intentionally lives in the global namespace (no namespace
// declaration) so that DocblockPropertyResolver::getNamespace() receives a
// class name with a single part and returns an empty string. It is loaded
// via require_once from the test because PSR-4 autoloading does not cover
// global-namespace classes.

/**
 * Global-namespace stub with a docblock property referencing a class name.
 *
 * @internal
 */
final class GlobalStubWithDocblock
{
    /** @var stdClass */
    public stdClass $value;
}