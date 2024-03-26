<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validator;

interface StaticMin
{
    public static function minBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public static function minBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public static function minEquals(mixed $compareTo): ChainedValidator&Validator;

    public static function minEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public static function minEven(): ChainedValidator&Validator;

    public static function minFactor(int $dividend): ChainedValidator&Validator;

    public static function minFibonacci(): ChainedValidator&Validator;

    public static function minFinite(): ChainedValidator&Validator;

    public static function minGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public static function minGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function minIdentical(mixed $compareTo): ChainedValidator&Validator;

    public static function minIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public static function minInfinite(): ChainedValidator&Validator;

    public static function minLessThan(mixed $compareTo): ChainedValidator&Validator;

    public static function minLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function minMultiple(int $multipleOf): ChainedValidator&Validator;

    public static function minOdd(): ChainedValidator&Validator;

    public static function minPerfectSquare(): ChainedValidator&Validator;

    public static function minPositive(): ChainedValidator&Validator;

    public static function minPrimeNumber(): ChainedValidator&Validator;
}
