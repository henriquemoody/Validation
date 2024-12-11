<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Pdp\Exception\UnableToProcessHost;
use Pdp\TopLevelDomains;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Standard;

use function array_pop;
use function count;
use function explode;
use function mb_substr_count;

#[Template(
    '{{name}} must be a valid domain',
    '{{name}} must not be a valid domain',
)]
final class Domain extends Standard
{
    public function __construct(
        private readonly bool $requireTld = true,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        if (!is_string($input)) {
            return Result::failed($input, $this);
        }

        try {
            $domain = \Pdp\Domain::fromIDNA2008($input);
            if (count($domain->labels()) === 1) {
                return Result::failed($input, $this);
            }

        } catch (\Throwable $e) {
            return Result::failed($input, $this);
        }

        return Result::passed($input, $this);
    }
}
