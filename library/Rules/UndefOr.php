<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateUndefined;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;

use function array_map;
use function count;

#[Template(
    'The value must be undefined',
    'The value must not be undefined',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be undefined',
    '{{name}} must not be undefined',
    self::TEMPLATE_NAMED,
)]
#[Template(
    'or must be undefined',
    'and must not be undefined',
    self::TEMPLATE_SIBLING,
)]
final class UndefOr extends Wrapper
{
    use CanValidateUndefined;

    public const TEMPLATE_NAMED = '__named__';
    public const TEMPLATE_SIBLING = '__sibling__';

    public function evaluate(mixed $input): Result
    {
        if (!$this->isUndefined($input)) {
            return $this->addSibling($this->rule->evaluate($input)->withPrefixedId('undefOr'));
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
