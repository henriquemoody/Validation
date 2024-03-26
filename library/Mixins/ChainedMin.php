<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validator;

interface ChainedMin
{
    public function minBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public function minBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public function minEquals(mixed $compareTo): ChainedValidator&Validator;

    public function minEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public function minEven(): ChainedValidator&Validator;

    public function minFactor(int $dividend): ChainedValidator&Validator;

    public function minFibonacci(): ChainedValidator&Validator;

    public function minFinite(): ChainedValidator&Validator;

    public function minGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public function minGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function minIdentical(mixed $compareTo): ChainedValidator&Validator;

    public function minIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public function minInfinite(): ChainedValidator&Validator;

    public function minLessThan(mixed $compareTo): ChainedValidator&Validator;

    public function minLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function minMultiple(int $multipleOf): ChainedValidator&Validator;

    public function minOdd(): ChainedValidator&Validator;

    public function minPerfectSquare(): ChainedValidator&Validator;

    public function minPositive(): ChainedValidator&Validator;

    public function minPrimeNumber(): ChainedValidator&Validator;
}
