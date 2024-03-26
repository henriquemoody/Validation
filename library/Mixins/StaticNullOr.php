<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface StaticNullOr
{
    public static function nullOrAllOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function nullOrAlnum(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrAlpha(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrAlwaysInvalid(): ChainedValidator&Validator;

    public static function nullOrAlwaysValid(): ChainedValidator&Validator;

    public static function nullOrAnyOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function nullOrArrayType(): ChainedValidator&Validator;

    public static function nullOrArrayVal(): ChainedValidator&Validator;

    public static function nullOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public static function nullOrBase64(): ChainedValidator&Validator;

    public static function nullOrBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public static function nullOrBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public static function nullOrBoolType(): ChainedValidator&Validator;

    public static function nullOrBoolVal(): ChainedValidator&Validator;

    public static function nullOrBsn(): ChainedValidator&Validator;

    public static function nullOrCall(callable $callable, Validatable $rule): ChainedValidator&Validator;

    public static function nullOrCallableType(): ChainedValidator&Validator;

    public static function nullOrCallback(callable $callback, mixed ...$arguments): ChainedValidator&Validator;

    public static function nullOrCharset(string $charset, string ...$charsets): ChainedValidator&Validator;

    public static function nullOrCnh(): ChainedValidator&Validator;

    public static function nullOrCnpj(): ChainedValidator&Validator;

    public static function nullOrConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function nullOrConsonant(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrContains(mixed $containsValue, bool $identical = false): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function nullOrContainsAny(array $needles, bool $identical = false): ChainedValidator&Validator;

    public static function nullOrControl(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrCountable(): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function nullOrCountryCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    public static function nullOrCpf(): ChainedValidator&Validator;

    public static function nullOrCreditCard(string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function nullOrCurrencyCode(string $set = 'alpha-3'): ChainedValidator&Validator;

    public static function nullOrDate(string $format = 'Y-m-d'): ChainedValidator&Validator;

    public static function nullOrDateTime(?string $format = null): ChainedValidator&Validator;

    public static function nullOrDecimal(int $decimals): ChainedValidator&Validator;

    public static function nullOrDigit(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrDirectory(): ChainedValidator&Validator;

    public static function nullOrDomain(bool $tldCheck = true): ChainedValidator&Validator;

    public static function nullOrEach(Validatable $rule): ChainedValidator&Validator;

    public static function nullOrEmail(): ChainedValidator&Validator;

    public static function nullOrEndsWith(mixed $endValue, bool $identical = false): ChainedValidator&Validator;

    public static function nullOrEquals(mixed $compareTo): ChainedValidator&Validator;

    public static function nullOrEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public static function nullOrEven(): ChainedValidator&Validator;

    public static function nullOrExecutable(): ChainedValidator&Validator;

    public static function nullOrExists(): ChainedValidator&Validator;

    public static function nullOrExtension(string $extension): ChainedValidator&Validator;

    public static function nullOrFactor(int $dividend): ChainedValidator&Validator;

    public static function nullOrFalseVal(): ChainedValidator&Validator;

    public static function nullOrFibonacci(): ChainedValidator&Validator;

    public static function nullOrFile(): ChainedValidator&Validator;

    public static function nullOrFilterVar(int $filter, mixed $options = null): ChainedValidator&Validator;

    public static function nullOrFinite(): ChainedValidator&Validator;

    public static function nullOrFloatType(): ChainedValidator&Validator;

    public static function nullOrFloatVal(): ChainedValidator&Validator;

    public static function nullOrGraph(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public static function nullOrGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function nullOrHetu(): ChainedValidator&Validator;

    public static function nullOrHexRgbColor(): ChainedValidator&Validator;

    public static function nullOrIban(): ChainedValidator&Validator;

    public static function nullOrIdentical(mixed $compareTo): ChainedValidator&Validator;

    public static function nullOrImage(): ChainedValidator&Validator;

    public static function nullOrImei(): ChainedValidator&Validator;

    public static function nullOrIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public static function nullOrInfinite(): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public static function nullOrInstance(string $class): ChainedValidator&Validator;

    public static function nullOrIntType(): ChainedValidator&Validator;

    public static function nullOrIntVal(): ChainedValidator&Validator;

    public static function nullOrIp(string $range = '*', ?int $options = null): ChainedValidator&Validator;

    public static function nullOrIsbn(): ChainedValidator&Validator;

    public static function nullOrIterableType(): ChainedValidator&Validator;

    public static function nullOrIterableVal(): ChainedValidator&Validator;

    public static function nullOrJson(): ChainedValidator&Validator;

    public static function nullOrKey(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public static function nullOrKeyExists(string|int $key): ChainedValidator&Validator;

    public static function nullOrKeyOptional(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public static function nullOrKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function nullOrLanguageCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function nullOrLazy(callable $ruleCreator): ChainedValidator&Validator;

    public static function nullOrLeapDate(string $format): ChainedValidator&Validator;

    public static function nullOrLeapYear(): ChainedValidator&Validator;

    public static function nullOrLength(Validatable $rule): ChainedValidator&Validator;

    public static function nullOrLessThan(mixed $compareTo): ChainedValidator&Validator;

    public static function nullOrLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function nullOrLowercase(): ChainedValidator&Validator;

    public static function nullOrLuhn(): ChainedValidator&Validator;

    public static function nullOrMacAddress(): ChainedValidator&Validator;

    public static function nullOrMax(Validatable $rule): ChainedValidator&Validator;

    public static function nullOrMaxAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public static function nullOrMimetype(string $mimetype): ChainedValidator&Validator;

    public static function nullOrMin(Validatable $rule): ChainedValidator&Validator;

    public static function nullOrMinAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public static function nullOrMultiple(int $multipleOf): ChainedValidator&Validator;

    public static function nullOrNegative(): ChainedValidator&Validator;

    public static function nullOrNfeAccessKey(): ChainedValidator&Validator;

    public static function nullOrNif(): ChainedValidator&Validator;

    public static function nullOrNip(): ChainedValidator&Validator;

    public static function nullOrNo(bool $useLocale = false): ChainedValidator&Validator;

    public static function nullOrNoWhitespace(): ChainedValidator&Validator;

    public static function nullOrNoneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function nullOrNot(Validatable $rule): ChainedValidator&Validator;

    public static function nullOrNotBlank(): ChainedValidator&Validator;

    public static function nullOrNotEmoji(): ChainedValidator&Validator;

    public static function nullOrNotEmpty(): ChainedValidator&Validator;

    public static function nullOrNotOptional(): ChainedValidator&Validator;

    public static function nullOrNullType(): ChainedValidator&Validator;

    public static function nullOrNumber(): ChainedValidator&Validator;

    public static function nullOrNumericVal(): ChainedValidator&Validator;

    public static function nullOrObjectType(): ChainedValidator&Validator;

    public static function nullOrOdd(): ChainedValidator&Validator;

    public static function nullOrOneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function nullOrPerfectSquare(): ChainedValidator&Validator;

    public static function nullOrPesel(): ChainedValidator&Validator;

    public static function nullOrPhone(?string $countryCode = null): ChainedValidator&Validator;

    public static function nullOrPhpLabel(): ChainedValidator&Validator;

    public static function nullOrPis(): ChainedValidator&Validator;

    public static function nullOrPolishIdCard(): ChainedValidator&Validator;

    public static function nullOrPortugueseNif(): ChainedValidator&Validator;

    public static function nullOrPositive(): ChainedValidator&Validator;

    public static function nullOrPostalCode(string $countryCode, bool $formatted = false): ChainedValidator&Validator;

    public static function nullOrPrimeNumber(): ChainedValidator&Validator;

    public static function nullOrPrintable(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrProperty(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function nullOrPropertyExists(string $propertyName): ChainedValidator&Validator;

    public static function nullOrPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function nullOrPublicDomainSuffix(): ChainedValidator&Validator;

    public static function nullOrPunct(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrReadable(): ChainedValidator&Validator;

    public static function nullOrRegex(string $regex): ChainedValidator&Validator;

    public static function nullOrResourceType(): ChainedValidator&Validator;

    public static function nullOrRoman(): ChainedValidator&Validator;

    public static function nullOrScalarVal(): ChainedValidator&Validator;

    public static function nullOrSize(
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator&Validator;

    public static function nullOrSlug(): ChainedValidator&Validator;

    public static function nullOrSorted(string $direction): ChainedValidator&Validator;

    public static function nullOrSpace(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrStartsWith(mixed $startValue, bool $identical = false): ChainedValidator&Validator;

    public static function nullOrStringType(): ChainedValidator&Validator;

    public static function nullOrStringVal(): ChainedValidator&Validator;

    public static function nullOrSubdivisionCode(string $countryCode): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public static function nullOrSubset(array $superset): ChainedValidator&Validator;

    public static function nullOrSymbolicLink(): ChainedValidator&Validator;

    public static function nullOrTime(string $format = 'H:i:s'): ChainedValidator&Validator;

    public static function nullOrTld(): ChainedValidator&Validator;

    public static function nullOrTrueVal(): ChainedValidator&Validator;

    public static function nullOrUnique(): ChainedValidator&Validator;

    public static function nullOrUploaded(): ChainedValidator&Validator;

    public static function nullOrUppercase(): ChainedValidator&Validator;

    public static function nullOrUrl(): ChainedValidator&Validator;

    public static function nullOrUuid(?int $version = null): ChainedValidator&Validator;

    public static function nullOrVersion(): ChainedValidator&Validator;

    public static function nullOrVideoUrl(?string $service = null): ChainedValidator&Validator;

    public static function nullOrVowel(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrWhen(
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator&Validator;

    public static function nullOrWritable(): ChainedValidator&Validator;

    public static function nullOrXdigit(string ...$additionalChars): ChainedValidator&Validator;

    public static function nullOrYes(bool $useLocale = false): ChainedValidator&Validator;
}
