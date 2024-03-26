<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validator;

interface ChainedLength
{
    public function lengthBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public function lengthBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public function lengthEquals(mixed $compareTo): ChainedValidator&Validator;

    public function lengthEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public function lengthEven(): ChainedValidator&Validator;

    public function lengthFactor(int $dividend): ChainedValidator&Validator;

    public function lengthFibonacci(): ChainedValidator&Validator;

    public function lengthFinite(): ChainedValidator&Validator;

    public function lengthGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public function lengthGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function lengthIdentical(mixed $compareTo): ChainedValidator&Validator;

    public function lengthIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public function lengthInfinite(): ChainedValidator&Validator;

    public function lengthLessThan(mixed $compareTo): ChainedValidator&Validator;

    public function lengthLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function lengthMultiple(int $multipleOf): ChainedValidator&Validator;

    public function lengthOdd(): ChainedValidator&Validator;

    public function lengthPerfectSquare(): ChainedValidator&Validator;

    public function lengthPositive(): ChainedValidator&Validator;

    public function lengthPrimeNumber(): ChainedValidator&Validator;
}
