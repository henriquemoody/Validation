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

#[Template(
    'or must be undefined',
    'and must not be undefined',
)]
final class UndefOr extends Wrapper
{
    use CanValidateUndefined;

    public function evaluate(mixed $input): Result
    {
        $result = $this->rule->evaluate($input);
        if (!$this->isUndefined($input)) {
            return $this->buildSibling($result);
        }

        if (!$result->isValid) {
            return $this->buildSibling($result->withInvertedValidation());
        }

        return $this->buildSibling($result);
    }

    private function buildSibling(Result $wrapped): Result
    {
        if ($wrapped->isSiblingCompatible()) {
            return $wrapped
                ->withPrefixedId('undefOr')
                ->withNextSibling(new Result($wrapped->isValid, $wrapped->input, $this));
        }

        return $wrapped->withChildren(
            ...array_map(fn(Result $child) => $this->buildSibling($child), $wrapped->children)
        );
    }
}
