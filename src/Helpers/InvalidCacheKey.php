<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Psr\SimpleCache\InvalidArgumentException;

/**
 * Concrete exception for invalid PSR-16 cache keys.
 *
 * PSR-16 defines {@see InvalidArgumentException} as an interface, not a class.
 * This exception extends PHP's native {@see \InvalidArgumentException} and
 * implements the PSR-16 interface so callers can catch by either type.
 *
 * @internal
 */
final class InvalidCacheKey extends \InvalidArgumentException implements InvalidArgumentException
{
}
