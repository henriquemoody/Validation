<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface ChainedUndefOr
{
    public function undefOrAllOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function undefOrAlnum(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrAlpha(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrAlwaysInvalid(): ChainedValidator&Validator;

    public function undefOrAlwaysValid(): ChainedValidator&Validator;

    public function undefOrAnyOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function undefOrArrayType(): ChainedValidator&Validator;

    public function undefOrArrayVal(): ChainedValidator&Validator;

    public function undefOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public function undefOrBase64(): ChainedValidator&Validator;

    public function undefOrBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public function undefOrBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public function undefOrBoolType(): ChainedValidator&Validator;

    public function undefOrBoolVal(): ChainedValidator&Validator;

    public function undefOrBsn(): ChainedValidator&Validator;

    public function undefOrCall(callable $callable, Validatable $rule): ChainedValidator&Validator;

    public function undefOrCallableType(): ChainedValidator&Validator;

    public function undefOrCallback(callable $callback, mixed ...$arguments): ChainedValidator&Validator;

    public function undefOrCharset(string $charset, string ...$charsets): ChainedValidator&Validator;

    public function undefOrCnh(): ChainedValidator&Validator;

    public function undefOrCnpj(): ChainedValidator&Validator;

    public function undefOrConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function undefOrConsonant(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrContains(mixed $containsValue, bool $identical = false): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function undefOrContainsAny(array $needles, bool $identical = false): ChainedValidator&Validator;

    public function undefOrControl(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrCountable(): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function undefOrCountryCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    public function undefOrCpf(): ChainedValidator&Validator;

    public function undefOrCreditCard(string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function undefOrCurrencyCode(string $set = 'alpha-3'): ChainedValidator&Validator;

    public function undefOrDate(string $format = 'Y-m-d'): ChainedValidator&Validator;

    public function undefOrDateTime(?string $format = null): ChainedValidator&Validator;

    public function undefOrDecimal(int $decimals): ChainedValidator&Validator;

    public function undefOrDigit(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrDirectory(): ChainedValidator&Validator;

    public function undefOrDomain(bool $tldCheck = true): ChainedValidator&Validator;

    public function undefOrEach(Validatable $rule): ChainedValidator&Validator;

    public function undefOrEmail(): ChainedValidator&Validator;

    public function undefOrEndsWith(mixed $endValue, bool $identical = false): ChainedValidator&Validator;

    public function undefOrEquals(mixed $compareTo): ChainedValidator&Validator;

    public function undefOrEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public function undefOrEven(): ChainedValidator&Validator;

    public function undefOrExecutable(): ChainedValidator&Validator;

    public function undefOrExists(): ChainedValidator&Validator;

    public function undefOrExtension(string $extension): ChainedValidator&Validator;

    public function undefOrFactor(int $dividend): ChainedValidator&Validator;

    public function undefOrFalseVal(): ChainedValidator&Validator;

    public function undefOrFibonacci(): ChainedValidator&Validator;

    public function undefOrFile(): ChainedValidator&Validator;

    public function undefOrFilterVar(int $filter, mixed $options = null): ChainedValidator&Validator;

    public function undefOrFinite(): ChainedValidator&Validator;

    public function undefOrFloatType(): ChainedValidator&Validator;

    public function undefOrFloatVal(): ChainedValidator&Validator;

    public function undefOrGraph(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public function undefOrGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function undefOrHetu(): ChainedValidator&Validator;

    public function undefOrHexRgbColor(): ChainedValidator&Validator;

    public function undefOrIban(): ChainedValidator&Validator;

    public function undefOrIdentical(mixed $compareTo): ChainedValidator&Validator;

    public function undefOrImage(): ChainedValidator&Validator;

    public function undefOrImei(): ChainedValidator&Validator;

    public function undefOrIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public function undefOrInfinite(): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public function undefOrInstance(string $class): ChainedValidator&Validator;

    public function undefOrIntType(): ChainedValidator&Validator;

    public function undefOrIntVal(): ChainedValidator&Validator;

    public function undefOrIp(string $range = '*', ?int $options = null): ChainedValidator&Validator;

    public function undefOrIsbn(): ChainedValidator&Validator;

    public function undefOrIterableType(): ChainedValidator&Validator;

    public function undefOrIterableVal(): ChainedValidator&Validator;

    public function undefOrJson(): ChainedValidator&Validator;

    public function undefOrKey(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public function undefOrKeyExists(string|int $key): ChainedValidator&Validator;

    public function undefOrKeyOptional(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public function undefOrKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function undefOrLanguageCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function undefOrLazy(callable $ruleCreator): ChainedValidator&Validator;

    public function undefOrLeapDate(string $format): ChainedValidator&Validator;

    public function undefOrLeapYear(): ChainedValidator&Validator;

    public function undefOrLength(Validatable $rule): ChainedValidator&Validator;

    public function undefOrLessThan(mixed $compareTo): ChainedValidator&Validator;

    public function undefOrLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function undefOrLowercase(): ChainedValidator&Validator;

    public function undefOrLuhn(): ChainedValidator&Validator;

    public function undefOrMacAddress(): ChainedValidator&Validator;

    public function undefOrMax(Validatable $rule): ChainedValidator&Validator;

    public function undefOrMaxAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public function undefOrMimetype(string $mimetype): ChainedValidator&Validator;

    public function undefOrMin(Validatable $rule): ChainedValidator&Validator;

    public function undefOrMinAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public function undefOrMultiple(int $multipleOf): ChainedValidator&Validator;

    public function undefOrNegative(): ChainedValidator&Validator;

    public function undefOrNfeAccessKey(): ChainedValidator&Validator;

    public function undefOrNif(): ChainedValidator&Validator;

    public function undefOrNip(): ChainedValidator&Validator;

    public function undefOrNo(bool $useLocale = false): ChainedValidator&Validator;

    public function undefOrNoWhitespace(): ChainedValidator&Validator;

    public function undefOrNoneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function undefOrNot(Validatable $rule): ChainedValidator&Validator;

    public function undefOrNotBlank(): ChainedValidator&Validator;

    public function undefOrNotEmoji(): ChainedValidator&Validator;

    public function undefOrNotEmpty(): ChainedValidator&Validator;

    public function undefOrNotOptional(): ChainedValidator&Validator;

    public function undefOrNullType(): ChainedValidator&Validator;

    public function undefOrNumber(): ChainedValidator&Validator;

    public function undefOrNumericVal(): ChainedValidator&Validator;

    public function undefOrObjectType(): ChainedValidator&Validator;

    public function undefOrOdd(): ChainedValidator&Validator;

    public function undefOrOneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function undefOrPerfectSquare(): ChainedValidator&Validator;

    public function undefOrPesel(): ChainedValidator&Validator;

    public function undefOrPhone(?string $countryCode = null): ChainedValidator&Validator;

    public function undefOrPhpLabel(): ChainedValidator&Validator;

    public function undefOrPis(): ChainedValidator&Validator;

    public function undefOrPolishIdCard(): ChainedValidator&Validator;

    public function undefOrPortugueseNif(): ChainedValidator&Validator;

    public function undefOrPositive(): ChainedValidator&Validator;

    public function undefOrPostalCode(string $countryCode, bool $formatted = false): ChainedValidator&Validator;

    public function undefOrPrimeNumber(): ChainedValidator&Validator;

    public function undefOrPrintable(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrProperty(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function undefOrPropertyExists(string $propertyName): ChainedValidator&Validator;

    public function undefOrPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function undefOrPublicDomainSuffix(): ChainedValidator&Validator;

    public function undefOrPunct(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrReadable(): ChainedValidator&Validator;

    public function undefOrRegex(string $regex): ChainedValidator&Validator;

    public function undefOrResourceType(): ChainedValidator&Validator;

    public function undefOrRoman(): ChainedValidator&Validator;

    public function undefOrScalarVal(): ChainedValidator&Validator;

    public function undefOrSize(
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator&Validator;

    public function undefOrSlug(): ChainedValidator&Validator;

    public function undefOrSorted(string $direction): ChainedValidator&Validator;

    public function undefOrSpace(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrStartsWith(mixed $startValue, bool $identical = false): ChainedValidator&Validator;

    public function undefOrStringType(): ChainedValidator&Validator;

    public function undefOrStringVal(): ChainedValidator&Validator;

    public function undefOrSubdivisionCode(string $countryCode): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public function undefOrSubset(array $superset): ChainedValidator&Validator;

    public function undefOrSymbolicLink(): ChainedValidator&Validator;

    public function undefOrTime(string $format = 'H:i:s'): ChainedValidator&Validator;

    public function undefOrTld(): ChainedValidator&Validator;

    public function undefOrTrueVal(): ChainedValidator&Validator;

    public function undefOrUnique(): ChainedValidator&Validator;

    public function undefOrUploaded(): ChainedValidator&Validator;

    public function undefOrUppercase(): ChainedValidator&Validator;

    public function undefOrUrl(): ChainedValidator&Validator;

    public function undefOrUuid(?int $version = null): ChainedValidator&Validator;

    public function undefOrVersion(): ChainedValidator&Validator;

    public function undefOrVideoUrl(?string $service = null): ChainedValidator&Validator;

    public function undefOrVowel(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrWhen(
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator&Validator;

    public function undefOrWritable(): ChainedValidator&Validator;

    public function undefOrXdigit(string ...$additionalChars): ChainedValidator&Validator;

    public function undefOrYes(bool $useLocale = false): ChainedValidator&Validator;
}
