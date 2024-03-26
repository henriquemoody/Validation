<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validator;

interface ChainedMax
{
    public function maxBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public function maxBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public function maxEquals(mixed $compareTo): ChainedValidator&Validator;

    public function maxEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public function maxEven(): ChainedValidator&Validator;

    public function maxFactor(int $dividend): ChainedValidator&Validator;

    public function maxFibonacci(): ChainedValidator&Validator;

    public function maxFinite(): ChainedValidator&Validator;

    public function maxGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public function maxGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function maxIdentical(mixed $compareTo): ChainedValidator&Validator;

    public function maxIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public function maxInfinite(): ChainedValidator&Validator;

    public function maxLessThan(mixed $compareTo): ChainedValidator&Validator;

    public function maxLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function maxMultiple(int $multipleOf): ChainedValidator&Validator;

    public function maxOdd(): ChainedValidator&Validator;

    public function maxPerfectSquare(): ChainedValidator&Validator;

    public function maxPositive(): ChainedValidator&Validator;

    public function maxPrimeNumber(): ChainedValidator&Validator;
}
