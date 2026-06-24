<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

/**
 * Object with a property typed as @var $this.
 *
 * `ThisTypeNode` is not handled by any branch of resolveTypeNode(), so the
 * resolver must return an empty array (the fallback return [] at the end of
 * resolveTypeNode()).
 */
final class WithThisTypeProperty
{
    /** @var $this */
    public self $value;
}