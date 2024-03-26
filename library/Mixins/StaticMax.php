<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validator;

interface StaticMax
{
    public static function maxBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public static function maxBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public static function maxEquals(mixed $compareTo): ChainedValidator&Validator;

    public static function maxEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public static function maxEven(): ChainedValidator&Validator;

    public static function maxFactor(int $dividend): ChainedValidator&Validator;

    public static function maxFibonacci(): ChainedValidator&Validator;

    public static function maxFinite(): ChainedValidator&Validator;

    public static function maxGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public static function maxGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function maxIdentical(mixed $compareTo): ChainedValidator&Validator;

    public static function maxIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public static function maxInfinite(): ChainedValidator&Validator;

    public static function maxLessThan(mixed $compareTo): ChainedValidator&Validator;

    public static function maxLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function maxMultiple(int $multipleOf): ChainedValidator&Validator;

    public static function maxOdd(): ChainedValidator&Validator;

    public static function maxPerfectSquare(): ChainedValidator&Validator;

    public static function maxPositive(): ChainedValidator&Validator;

    public static function maxPrimeNumber(): ChainedValidator&Validator;
}
