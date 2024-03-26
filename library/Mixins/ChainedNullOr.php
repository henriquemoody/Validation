<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface ChainedNullOr
{
    public function nullOrAllOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function nullOrAlnum(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrAlpha(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrAlwaysInvalid(): ChainedValidator&Validator;

    public function nullOrAlwaysValid(): ChainedValidator&Validator;

    public function nullOrAnyOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function nullOrArrayType(): ChainedValidator&Validator;

    public function nullOrArrayVal(): ChainedValidator&Validator;

    public function nullOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public function nullOrBase64(): ChainedValidator&Validator;

    public function nullOrBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public function nullOrBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public function nullOrBoolType(): ChainedValidator&Validator;

    public function nullOrBoolVal(): ChainedValidator&Validator;

    public function nullOrBsn(): ChainedValidator&Validator;

    public function nullOrCall(callable $callable, Validatable $rule): ChainedValidator&Validator;

    public function nullOrCallableType(): ChainedValidator&Validator;

    public function nullOrCallback(callable $callback, mixed ...$arguments): ChainedValidator&Validator;

    public function nullOrCharset(string $charset, string ...$charsets): ChainedValidator&Validator;

    public function nullOrCnh(): ChainedValidator&Validator;

    public function nullOrCnpj(): ChainedValidator&Validator;

    public function nullOrConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function nullOrConsonant(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrContains(mixed $containsValue, bool $identical = false): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function nullOrContainsAny(array $needles, bool $identical = false): ChainedValidator&Validator;

    public function nullOrControl(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrCountable(): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function nullOrCountryCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    public function nullOrCpf(): ChainedValidator&Validator;

    public function nullOrCreditCard(string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function nullOrCurrencyCode(string $set = 'alpha-3'): ChainedValidator&Validator;

    public function nullOrDate(string $format = 'Y-m-d'): ChainedValidator&Validator;

    public function nullOrDateTime(?string $format = null): ChainedValidator&Validator;

    public function nullOrDecimal(int $decimals): ChainedValidator&Validator;

    public function nullOrDigit(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrDirectory(): ChainedValidator&Validator;

    public function nullOrDomain(bool $tldCheck = true): ChainedValidator&Validator;

    public function nullOrEach(Validatable $rule): ChainedValidator&Validator;

    public function nullOrEmail(): ChainedValidator&Validator;

    public function nullOrEndsWith(mixed $endValue, bool $identical = false): ChainedValidator&Validator;

    public function nullOrEquals(mixed $compareTo): ChainedValidator&Validator;

    public function nullOrEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public function nullOrEven(): ChainedValidator&Validator;

    public function nullOrExecutable(): ChainedValidator&Validator;

    public function nullOrExists(): ChainedValidator&Validator;

    public function nullOrExtension(string $extension): ChainedValidator&Validator;

    public function nullOrFactor(int $dividend): ChainedValidator&Validator;

    public function nullOrFalseVal(): ChainedValidator&Validator;

    public function nullOrFibonacci(): ChainedValidator&Validator;

    public function nullOrFile(): ChainedValidator&Validator;

    public function nullOrFilterVar(int $filter, mixed $options = null): ChainedValidator&Validator;

    public function nullOrFinite(): ChainedValidator&Validator;

    public function nullOrFloatType(): ChainedValidator&Validator;

    public function nullOrFloatVal(): ChainedValidator&Validator;

    public function nullOrGraph(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public function nullOrGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function nullOrHetu(): ChainedValidator&Validator;

    public function nullOrHexRgbColor(): ChainedValidator&Validator;

    public function nullOrIban(): ChainedValidator&Validator;

    public function nullOrIdentical(mixed $compareTo): ChainedValidator&Validator;

    public function nullOrImage(): ChainedValidator&Validator;

    public function nullOrImei(): ChainedValidator&Validator;

    public function nullOrIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public function nullOrInfinite(): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public function nullOrInstance(string $class): ChainedValidator&Validator;

    public function nullOrIntType(): ChainedValidator&Validator;

    public function nullOrIntVal(): ChainedValidator&Validator;

    public function nullOrIp(string $range = '*', ?int $options = null): ChainedValidator&Validator;

    public function nullOrIsbn(): ChainedValidator&Validator;

    public function nullOrIterableType(): ChainedValidator&Validator;

    public function nullOrIterableVal(): ChainedValidator&Validator;

    public function nullOrJson(): ChainedValidator&Validator;

    public function nullOrKey(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public function nullOrKeyExists(string|int $key): ChainedValidator&Validator;

    public function nullOrKeyOptional(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public function nullOrKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function nullOrLanguageCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function nullOrLazy(callable $ruleCreator): ChainedValidator&Validator;

    public function nullOrLeapDate(string $format): ChainedValidator&Validator;

    public function nullOrLeapYear(): ChainedValidator&Validator;

    public function nullOrLength(Validatable $rule): ChainedValidator&Validator;

    public function nullOrLessThan(mixed $compareTo): ChainedValidator&Validator;

    public function nullOrLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function nullOrLowercase(): ChainedValidator&Validator;

    public function nullOrLuhn(): ChainedValidator&Validator;

    public function nullOrMacAddress(): ChainedValidator&Validator;

    public function nullOrMax(Validatable $rule): ChainedValidator&Validator;

    public function nullOrMaxAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public function nullOrMimetype(string $mimetype): ChainedValidator&Validator;

    public function nullOrMin(Validatable $rule): ChainedValidator&Validator;

    public function nullOrMinAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public function nullOrMultiple(int $multipleOf): ChainedValidator&Validator;

    public function nullOrNegative(): ChainedValidator&Validator;

    public function nullOrNfeAccessKey(): ChainedValidator&Validator;

    public function nullOrNif(): ChainedValidator&Validator;

    public function nullOrNip(): ChainedValidator&Validator;

    public function nullOrNo(bool $useLocale = false): ChainedValidator&Validator;

    public function nullOrNoWhitespace(): ChainedValidator&Validator;

    public function nullOrNoneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function nullOrNot(Validatable $rule): ChainedValidator&Validator;

    public function nullOrNotBlank(): ChainedValidator&Validator;

    public function nullOrNotEmoji(): ChainedValidator&Validator;

    public function nullOrNotEmpty(): ChainedValidator&Validator;

    public function nullOrNotOptional(): ChainedValidator&Validator;

    public function nullOrNullType(): ChainedValidator&Validator;

    public function nullOrNumber(): ChainedValidator&Validator;

    public function nullOrNumericVal(): ChainedValidator&Validator;

    public function nullOrObjectType(): ChainedValidator&Validator;

    public function nullOrOdd(): ChainedValidator&Validator;

    public function nullOrOneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function nullOrPerfectSquare(): ChainedValidator&Validator;

    public function nullOrPesel(): ChainedValidator&Validator;

    public function nullOrPhone(?string $countryCode = null): ChainedValidator&Validator;

    public function nullOrPhpLabel(): ChainedValidator&Validator;

    public function nullOrPis(): ChainedValidator&Validator;

    public function nullOrPolishIdCard(): ChainedValidator&Validator;

    public function nullOrPortugueseNif(): ChainedValidator&Validator;

    public function nullOrPositive(): ChainedValidator&Validator;

    public function nullOrPostalCode(string $countryCode, bool $formatted = false): ChainedValidator&Validator;

    public function nullOrPrimeNumber(): ChainedValidator&Validator;

    public function nullOrPrintable(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrProperty(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function nullOrPropertyExists(string $propertyName): ChainedValidator&Validator;

    public function nullOrPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function nullOrPublicDomainSuffix(): ChainedValidator&Validator;

    public function nullOrPunct(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrReadable(): ChainedValidator&Validator;

    public function nullOrRegex(string $regex): ChainedValidator&Validator;

    public function nullOrResourceType(): ChainedValidator&Validator;

    public function nullOrRoman(): ChainedValidator&Validator;

    public function nullOrScalarVal(): ChainedValidator&Validator;

    public function nullOrSize(
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator&Validator;

    public function nullOrSlug(): ChainedValidator&Validator;

    public function nullOrSorted(string $direction): ChainedValidator&Validator;

    public function nullOrSpace(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrStartsWith(mixed $startValue, bool $identical = false): ChainedValidator&Validator;

    public function nullOrStringType(): ChainedValidator&Validator;

    public function nullOrStringVal(): ChainedValidator&Validator;

    public function nullOrSubdivisionCode(string $countryCode): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public function nullOrSubset(array $superset): ChainedValidator&Validator;

    public function nullOrSymbolicLink(): ChainedValidator&Validator;

    public function nullOrTime(string $format = 'H:i:s'): ChainedValidator&Validator;

    public function nullOrTld(): ChainedValidator&Validator;

    public function nullOrTrueVal(): ChainedValidator&Validator;

    public function nullOrUnique(): ChainedValidator&Validator;

    public function nullOrUploaded(): ChainedValidator&Validator;

    public function nullOrUppercase(): ChainedValidator&Validator;

    public function nullOrUrl(): ChainedValidator&Validator;

    public function nullOrUuid(?int $version = null): ChainedValidator&Validator;

    public function nullOrVersion(): ChainedValidator&Validator;

    public function nullOrVideoUrl(?string $service = null): ChainedValidator&Validator;

    public function nullOrVowel(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrWhen(
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator&Validator;

    public function nullOrWritable(): ChainedValidator&Validator;

    public function nullOrXdigit(string ...$additionalChars): ChainedValidator&Validator;

    public function nullOrYes(bool $useLocale = false): ChainedValidator&Validator;
}
