<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface StaticUndefOr
{
    public static function undefOrAllOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function undefOrAlnum(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrAlpha(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrAlwaysInvalid(): ChainedValidator&Validator;

    public static function undefOrAlwaysValid(): ChainedValidator&Validator;

    public static function undefOrAnyOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function undefOrArrayType(): ChainedValidator&Validator;

    public static function undefOrArrayVal(): ChainedValidator&Validator;

    public static function undefOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public static function undefOrBase64(): ChainedValidator&Validator;

    public static function undefOrBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public static function undefOrBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public static function undefOrBoolType(): ChainedValidator&Validator;

    public static function undefOrBoolVal(): ChainedValidator&Validator;

    public static function undefOrBsn(): ChainedValidator&Validator;

    public static function undefOrCall(callable $callable, Validatable $rule): ChainedValidator&Validator;

    public static function undefOrCallableType(): ChainedValidator&Validator;

    public static function undefOrCallback(callable $callback, mixed ...$arguments): ChainedValidator&Validator;

    public static function undefOrCharset(string $charset, string ...$charsets): ChainedValidator&Validator;

    public static function undefOrCnh(): ChainedValidator&Validator;

    public static function undefOrCnpj(): ChainedValidator&Validator;

    public static function undefOrConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function undefOrConsonant(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrContains(mixed $containsValue, bool $identical = false): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function undefOrContainsAny(array $needles, bool $identical = false): ChainedValidator&Validator;

    public static function undefOrControl(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrCountable(): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function undefOrCountryCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    public static function undefOrCpf(): ChainedValidator&Validator;

    public static function undefOrCreditCard(string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function undefOrCurrencyCode(string $set = 'alpha-3'): ChainedValidator&Validator;

    public static function undefOrDate(string $format = 'Y-m-d'): ChainedValidator&Validator;

    public static function undefOrDateTime(?string $format = null): ChainedValidator&Validator;

    public static function undefOrDecimal(int $decimals): ChainedValidator&Validator;

    public static function undefOrDigit(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrDirectory(): ChainedValidator&Validator;

    public static function undefOrDomain(bool $tldCheck = true): ChainedValidator&Validator;

    public static function undefOrEach(Validatable $rule): ChainedValidator&Validator;

    public static function undefOrEmail(): ChainedValidator&Validator;

    public static function undefOrEndsWith(mixed $endValue, bool $identical = false): ChainedValidator&Validator;

    public static function undefOrEquals(mixed $compareTo): ChainedValidator&Validator;

    public static function undefOrEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public static function undefOrEven(): ChainedValidator&Validator;

    public static function undefOrExecutable(): ChainedValidator&Validator;

    public static function undefOrExists(): ChainedValidator&Validator;

    public static function undefOrExtension(string $extension): ChainedValidator&Validator;

    public static function undefOrFactor(int $dividend): ChainedValidator&Validator;

    public static function undefOrFalseVal(): ChainedValidator&Validator;

    public static function undefOrFibonacci(): ChainedValidator&Validator;

    public static function undefOrFile(): ChainedValidator&Validator;

    public static function undefOrFilterVar(int $filter, mixed $options = null): ChainedValidator&Validator;

    public static function undefOrFinite(): ChainedValidator&Validator;

    public static function undefOrFloatType(): ChainedValidator&Validator;

    public static function undefOrFloatVal(): ChainedValidator&Validator;

    public static function undefOrGraph(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public static function undefOrGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function undefOrHetu(): ChainedValidator&Validator;

    public static function undefOrHexRgbColor(): ChainedValidator&Validator;

    public static function undefOrIban(): ChainedValidator&Validator;

    public static function undefOrIdentical(mixed $compareTo): ChainedValidator&Validator;

    public static function undefOrImage(): ChainedValidator&Validator;

    public static function undefOrImei(): ChainedValidator&Validator;

    public static function undefOrIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public static function undefOrInfinite(): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public static function undefOrInstance(string $class): ChainedValidator&Validator;

    public static function undefOrIntType(): ChainedValidator&Validator;

    public static function undefOrIntVal(): ChainedValidator&Validator;

    public static function undefOrIp(string $range = '*', ?int $options = null): ChainedValidator&Validator;

    public static function undefOrIsbn(): ChainedValidator&Validator;

    public static function undefOrIterableType(): ChainedValidator&Validator;

    public static function undefOrIterableVal(): ChainedValidator&Validator;

    public static function undefOrJson(): ChainedValidator&Validator;

    public static function undefOrKey(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public static function undefOrKeyExists(string|int $key): ChainedValidator&Validator;

    public static function undefOrKeyOptional(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public static function undefOrKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function undefOrLanguageCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function undefOrLazy(callable $ruleCreator): ChainedValidator&Validator;

    public static function undefOrLeapDate(string $format): ChainedValidator&Validator;

    public static function undefOrLeapYear(): ChainedValidator&Validator;

    public static function undefOrLength(Validatable $rule): ChainedValidator&Validator;

    public static function undefOrLessThan(mixed $compareTo): ChainedValidator&Validator;

    public static function undefOrLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function undefOrLowercase(): ChainedValidator&Validator;

    public static function undefOrLuhn(): ChainedValidator&Validator;

    public static function undefOrMacAddress(): ChainedValidator&Validator;

    public static function undefOrMax(Validatable $rule): ChainedValidator&Validator;

    public static function undefOrMaxAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public static function undefOrMimetype(string $mimetype): ChainedValidator&Validator;

    public static function undefOrMin(Validatable $rule): ChainedValidator&Validator;

    public static function undefOrMinAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public static function undefOrMultiple(int $multipleOf): ChainedValidator&Validator;

    public static function undefOrNegative(): ChainedValidator&Validator;

    public static function undefOrNfeAccessKey(): ChainedValidator&Validator;

    public static function undefOrNif(): ChainedValidator&Validator;

    public static function undefOrNip(): ChainedValidator&Validator;

    public static function undefOrNo(bool $useLocale = false): ChainedValidator&Validator;

    public static function undefOrNoWhitespace(): ChainedValidator&Validator;

    public static function undefOrNoneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function undefOrNot(Validatable $rule): ChainedValidator&Validator;

    public static function undefOrNotBlank(): ChainedValidator&Validator;

    public static function undefOrNotEmoji(): ChainedValidator&Validator;

    public static function undefOrNotEmpty(): ChainedValidator&Validator;

    public static function undefOrNotOptional(): ChainedValidator&Validator;

    public static function undefOrNullType(): ChainedValidator&Validator;

    public static function undefOrNumber(): ChainedValidator&Validator;

    public static function undefOrNumericVal(): ChainedValidator&Validator;

    public static function undefOrObjectType(): ChainedValidator&Validator;

    public static function undefOrOdd(): ChainedValidator&Validator;

    public static function undefOrOneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function undefOrPerfectSquare(): ChainedValidator&Validator;

    public static function undefOrPesel(): ChainedValidator&Validator;

    public static function undefOrPhone(?string $countryCode = null): ChainedValidator&Validator;

    public static function undefOrPhpLabel(): ChainedValidator&Validator;

    public static function undefOrPis(): ChainedValidator&Validator;

    public static function undefOrPolishIdCard(): ChainedValidator&Validator;

    public static function undefOrPortugueseNif(): ChainedValidator&Validator;

    public static function undefOrPositive(): ChainedValidator&Validator;

    public static function undefOrPostalCode(string $countryCode, bool $formatted = false): ChainedValidator&Validator;

    public static function undefOrPrimeNumber(): ChainedValidator&Validator;

    public static function undefOrPrintable(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrProperty(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function undefOrPropertyExists(string $propertyName): ChainedValidator&Validator;

    public static function undefOrPropertyOptional(
        string $propertyName,
        Validatable $rule,
    ): ChainedValidator&Validator;

    public static function undefOrPublicDomainSuffix(): ChainedValidator&Validator;

    public static function undefOrPunct(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrReadable(): ChainedValidator&Validator;

    public static function undefOrRegex(string $regex): ChainedValidator&Validator;

    public static function undefOrResourceType(): ChainedValidator&Validator;

    public static function undefOrRoman(): ChainedValidator&Validator;

    public static function undefOrScalarVal(): ChainedValidator&Validator;

    public static function undefOrSize(
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator&Validator;

    public static function undefOrSlug(): ChainedValidator&Validator;

    public static function undefOrSorted(string $direction): ChainedValidator&Validator;

    public static function undefOrSpace(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrStartsWith(mixed $startValue, bool $identical = false): ChainedValidator&Validator;

    public static function undefOrStringType(): ChainedValidator&Validator;

    public static function undefOrStringVal(): ChainedValidator&Validator;

    public static function undefOrSubdivisionCode(string $countryCode): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public static function undefOrSubset(array $superset): ChainedValidator&Validator;

    public static function undefOrSymbolicLink(): ChainedValidator&Validator;

    public static function undefOrTime(string $format = 'H:i:s'): ChainedValidator&Validator;

    public static function undefOrTld(): ChainedValidator&Validator;

    public static function undefOrTrueVal(): ChainedValidator&Validator;

    public static function undefOrUnique(): ChainedValidator&Validator;

    public static function undefOrUploaded(): ChainedValidator&Validator;

    public static function undefOrUppercase(): ChainedValidator&Validator;

    public static function undefOrUrl(): ChainedValidator&Validator;

    public static function undefOrUuid(?int $version = null): ChainedValidator&Validator;

    public static function undefOrVersion(): ChainedValidator&Validator;

    public static function undefOrVideoUrl(?string $service = null): ChainedValidator&Validator;

    public static function undefOrVowel(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrWhen(
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator&Validator;

    public static function undefOrWritable(): ChainedValidator&Validator;

    public static function undefOrXdigit(string ...$additionalChars): ChainedValidator&Validator;

    public static function undefOrYes(bool $useLocale = false): ChainedValidator&Validator;
}
