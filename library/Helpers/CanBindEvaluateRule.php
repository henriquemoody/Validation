<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Respect\Validation\Result;
use Respect\Validation\Rule;

trait CanBindEvaluateRule
{
    private function bindEvaluate(Rule $binded, Rule $binder, mixed $input): Result
    {
        if ($binder->getName() !== null && $binded->getName() === null) {
            $binded->setName($binder->getName());
        }

        if ($binder->getTemplate() !== null && $binded->getTemplate() === null) {
            $binded->setTemplate($binder->getTemplate());
        }

        return $binded->evaluate($input);
    }
}
