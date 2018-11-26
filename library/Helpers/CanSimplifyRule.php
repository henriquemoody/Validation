<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Respect\Validation\Rules\AllOf;
use Respect\Validation\Validatable;
use function count;
use function current;

trait CanSimplifyRule
{
    private function simplifyRule(Validatable $rule): Validatable
    {
        if (!$rule instanceof AllOf) {
            return $rule;
        }

        $rules = $rule->getRules();
        if (count($rules) === 1) {
            return $this->simplifyRule(current($rules));
        }

        return $rule;
    }
}
