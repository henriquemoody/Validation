<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validator;

interface StaticLength
{
    public static function lengthBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public static function lengthBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public static function lengthEquals(mixed $compareTo): ChainedValidator&Validator;

    public static function lengthEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public static function lengthEven(): ChainedValidator&Validator;

    public static function lengthFactor(int $dividend): ChainedValidator&Validator;

    public static function lengthFibonacci(): ChainedValidator&Validator;

    public static function lengthFinite(): ChainedValidator&Validator;

    public static function lengthGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public static function lengthGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function lengthIdentical(mixed $compareTo): ChainedValidator&Validator;

    public static function lengthIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public static function lengthInfinite(): ChainedValidator&Validator;

    public static function lengthLessThan(mixed $compareTo): ChainedValidator&Validator;

    public static function lengthLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function lengthMultiple(int $multipleOf): ChainedValidator&Validator;

    public static function lengthOdd(): ChainedValidator&Validator;

    public static function lengthPerfectSquare(): ChainedValidator&Validator;

    public static function lengthPositive(): ChainedValidator&Validator;

    public static function lengthPrimeNumber(): ChainedValidator&Validator;
}
