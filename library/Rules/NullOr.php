<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;

use function array_map;
use function count;

#[Template(
    'The value must be null',
    'The value must not be null',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be null',
    '{{name}} must not be null',
    self::TEMPLATE_NAMED,
)]
#[Template(
    'or must be null',
    'and must not be null',
    self::TEMPLATE_SIBLING,
)]
final class NullOr extends Wrapper
{
    public const TEMPLATE_NAMED = '__named__';
    public const TEMPLATE_SIBLING = '__sibling__';

    public function evaluate(mixed $input): Result
    {
        if ($input !== null) {
            return $this->addSibling($this->rule->evaluate($input)->withPrefixedId('nullOr'));
        }

        if ($this->getName()) {
            return Result::passed($input, $this, [], self::TEMPLATE_NAMED);
        }

        return Result::passed($input, $this);
    }

    protected function addSibling(Result $result): Result
    {
        if (count($result->children) === 0) {
            return $result->withNextSibling(
                new Result($result->isValid, $result->input, $this, [], self::TEMPLATE_SIBLING)
            );
        }

        return $result->withChildren(...array_map(fn(Result $child) => $this->addSibling($child), $result->children));
    }
}
