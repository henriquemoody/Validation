<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface StaticProperty
{
    public static function propertyAllOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function propertyAlnum(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public static function propertyAlpha(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public static function propertyAlwaysInvalid(string $propertyName): ChainedValidator&Validator;

    public static function propertyAlwaysValid(string $propertyName): ChainedValidator&Validator;

    public static function propertyAnyOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function propertyArrayType(string $propertyName): ChainedValidator&Validator;

    public static function propertyArrayVal(string $propertyName): ChainedValidator&Validator;

    public static function propertyBase(
        string $propertyName,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public static function propertyBase64(string $propertyName): ChainedValidator&Validator;

    public static function propertyBetween(
        string $propertyName,
        mixed $minValue,
        mixed $maxValue,
    ): ChainedValidator&Validator;

    public static function propertyBetweenExclusive(
        string $propertyName,
        mixed $minimum,
        mixed $maximum,
    ): ChainedValidator&Validator;

    public static function propertyBoolType(string $propertyName): ChainedValidator&Validator;

    public static function propertyBoolVal(string $propertyName): ChainedValidator&Validator;

    public static function propertyBsn(string $propertyName): ChainedValidator&Validator;

    public static function propertyCall(
        string $propertyName,
        callable $callable,
        Validatable $rule,
    ): ChainedValidator&Validator;

    public static function propertyCallableType(string $propertyName): ChainedValidator&Validator;

    public static function propertyCallback(
        string $propertyName,
        callable $callback,
        mixed ...$arguments,
    ): ChainedValidator&Validator;

    public static function propertyCharset(
        string $propertyName,
        string $charset,
        string ...$charsets,
    ): ChainedValidator&Validator;

    public static function propertyCnh(string $propertyName): ChainedValidator&Validator;

    public static function propertyCnpj(string $propertyName): ChainedValidator&Validator;

    public static function propertyConsecutive(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function propertyConsonant(
        string $propertyName,
        string ...$additionalChars,
    ): ChainedValidator&Validator;

    public static function propertyContains(
        string $propertyName,
        mixed $containsValue,
        bool $identical = false,
    ): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function propertyContainsAny(
        string $propertyName,
        array $needles,
        bool $identical = false,
    ): ChainedValidator&Validator;

    public static function propertyControl(
        string $propertyName,
        string ...$additionalChars,
    ): ChainedValidator&Validator;

    public static function propertyCountable(string $propertyName): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function propertyCountryCode(
        string $propertyName,
        string $set = 'alpha-2',
    ): ChainedValidator&Validator;

    public static function propertyCpf(string $propertyName): ChainedValidator&Validator;

    public static function propertyCreditCard(string $propertyName, string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function propertyCurrencyCode(
        string $propertyName,
        string $set = 'alpha-3',
    ): ChainedValidator&Validator;

    public static function propertyDate(string $propertyName, string $format = 'Y-m-d'): ChainedValidator&Validator;

    public static function propertyDateTime(string $propertyName, ?string $format = null): ChainedValidator&Validator;

    public static function propertyDecimal(string $propertyName, int $decimals): ChainedValidator&Validator;

    public static function propertyDigit(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public static function propertyDirectory(string $propertyName): ChainedValidator&Validator;

    public static function propertyDomain(string $propertyName, bool $tldCheck = true): ChainedValidator&Validator;

    public static function propertyEach(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function propertyEmail(string $propertyName): ChainedValidator&Validator;

    public static function propertyEndsWith(
        string $propertyName,
        mixed $endValue,
        bool $identical = false,
    ): ChainedValidator&Validator;

    public static function propertyEquals(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public static function propertyEquivalent(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public static function propertyEven(string $propertyName): ChainedValidator&Validator;

    public static function propertyExecutable(string $propertyName): ChainedValidator&Validator;

    public static function propertyExtension(string $propertyName, string $extension): ChainedValidator&Validator;

    public static function propertyFactor(string $propertyName, int $dividend): ChainedValidator&Validator;

    public static function propertyFalseVal(string $propertyName): ChainedValidator&Validator;

    public static function propertyFibonacci(string $propertyName): ChainedValidator&Validator;

    public static function propertyFile(string $propertyName): ChainedValidator&Validator;

    public static function propertyFilterVar(
        string $propertyName,
        int $filter,
        mixed $options = null,
    ): ChainedValidator&Validator;

    public static function propertyFinite(string $propertyName): ChainedValidator&Validator;

    public static function propertyFloatType(string $propertyName): ChainedValidator&Validator;

    public static function propertyFloatVal(string $propertyName): ChainedValidator&Validator;

    public static function propertyGraph(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public static function propertyGreaterThan(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public static function propertyGreaterThanOrEqual(
        string $propertyName,
        mixed $compareTo,
    ): ChainedValidator&Validator;

    public static function propertyHetu(string $propertyName): ChainedValidator&Validator;

    public static function propertyHexRgbColor(string $propertyName): ChainedValidator&Validator;

    public static function propertyIban(string $propertyName): ChainedValidator&Validator;

    public static function propertyIdentical(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public static function propertyImage(string $propertyName): ChainedValidator&Validator;

    public static function propertyImei(string $propertyName): ChainedValidator&Validator;

    public static function propertyIn(
        string $propertyName,
        mixed $haystack,
        bool $compareIdentical = false,
    ): ChainedValidator&Validator;

    public static function propertyInfinite(string $propertyName): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public static function propertyInstance(string $propertyName, string $class): ChainedValidator&Validator;

    public static function propertyIntType(string $propertyName): ChainedValidator&Validator;

    public static function propertyIntVal(string $propertyName): ChainedValidator&Validator;

    public static function propertyIp(
        string $propertyName,
        string $range = '*',
        ?int $options = null,
    ): ChainedValidator&Validator;

    public static function propertyIsbn(string $propertyName): ChainedValidator&Validator;

    public static function propertyIterableType(string $propertyName): ChainedValidator&Validator;

    public static function propertyIterableVal(string $propertyName): ChainedValidator&Validator;

    public static function propertyJson(string $propertyName): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function propertyLanguageCode(
        string $propertyName,
        string $set = 'alpha-2',
    ): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function propertyLazy(string $propertyName, callable $ruleCreator): ChainedValidator&Validator;

    public static function propertyLeapDate(string $propertyName, string $format): ChainedValidator&Validator;

    public static function propertyLeapYear(string $propertyName): ChainedValidator&Validator;

    public static function propertyLength(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function propertyLessThan(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public static function propertyLessThanOrEqual(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public static function propertyLowercase(string $propertyName): ChainedValidator&Validator;

    public static function propertyLuhn(string $propertyName): ChainedValidator&Validator;

    public static function propertyMacAddress(string $propertyName): ChainedValidator&Validator;

    public static function propertyMax(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function propertyMaxAge(
        string $propertyName,
        int $age,
        ?string $format = null,
    ): ChainedValidator&Validator;

    public static function propertyMimetype(string $propertyName, string $mimetype): ChainedValidator&Validator;

    public static function propertyMin(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function propertyMinAge(
        string $propertyName,
        int $age,
        ?string $format = null,
    ): ChainedValidator&Validator;

    public static function propertyMultiple(string $propertyName, int $multipleOf): ChainedValidator&Validator;

    public static function propertyNegative(string $propertyName): ChainedValidator&Validator;

    public static function propertyNfeAccessKey(string $propertyName): ChainedValidator&Validator;

    public static function propertyNif(string $propertyName): ChainedValidator&Validator;

    public static function propertyNip(string $propertyName): ChainedValidator&Validator;

    public static function propertyNo(string $propertyName, bool $useLocale = false): ChainedValidator&Validator;

    public static function propertyNoWhitespace(string $propertyName): ChainedValidator&Validator;

    public static function propertyNoneOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function propertyNot(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function propertyNotBlank(string $propertyName): ChainedValidator&Validator;

    public static function propertyNotEmoji(string $propertyName): ChainedValidator&Validator;

    public static function propertyNotEmpty(string $propertyName): ChainedValidator&Validator;

    public static function propertyNotOptional(string $propertyName): ChainedValidator&Validator;

    public static function propertyNullType(string $propertyName): ChainedValidator&Validator;

    public static function propertyNumber(string $propertyName): ChainedValidator&Validator;

    public static function propertyNumericVal(string $propertyName): ChainedValidator&Validator;

    public static function propertyObjectType(string $propertyName): ChainedValidator&Validator;

    public static function propertyOdd(string $propertyName): ChainedValidator&Validator;

    public static function propertyOneOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function propertyPerfectSquare(string $propertyName): ChainedValidator&Validator;

    public static function propertyPesel(string $propertyName): ChainedValidator&Validator;

    public static function propertyPhone(string $propertyName, ?string $countryCode = null): ChainedValidator&Validator;

    public static function propertyPhpLabel(string $propertyName): ChainedValidator&Validator;

    public static function propertyPis(string $propertyName): ChainedValidator&Validator;

    public static function propertyPolishIdCard(string $propertyName): ChainedValidator&Validator;

    public static function propertyPortugueseNif(string $propertyName): ChainedValidator&Validator;

    public static function propertyPositive(string $propertyName): ChainedValidator&Validator;

    public static function propertyPostalCode(
        string $propertyName,
        string $countryCode,
        bool $formatted = false,
    ): ChainedValidator&Validator;

    public static function propertyPrimeNumber(string $propertyName): ChainedValidator&Validator;

    public static function propertyPrintable(
        string $propertyName,
        string ...$additionalChars,
    ): ChainedValidator&Validator;

    public static function propertyPublicDomainSuffix(string $propertyName): ChainedValidator&Validator;

    public static function propertyPunct(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public static function propertyReadable(string $propertyName): ChainedValidator&Validator;

    public static function propertyRegex(string $propertyName, string $regex): ChainedValidator&Validator;

    public static function propertyResourceType(string $propertyName): ChainedValidator&Validator;

    public static function propertyRoman(string $propertyName): ChainedValidator&Validator;

    public static function propertyScalarVal(string $propertyName): ChainedValidator&Validator;

    public static function propertySize(
        string $propertyName,
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator&Validator;

    public static function propertySlug(string $propertyName): ChainedValidator&Validator;

    public static function propertySorted(string $propertyName, string $direction): ChainedValidator&Validator;

    public static function propertySpace(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public static function propertyStartsWith(
        string $propertyName,
        mixed $startValue,
        bool $identical = false,
    ): ChainedValidator&Validator;

    public static function propertyStringType(string $propertyName): ChainedValidator&Validator;

    public static function propertyStringVal(string $propertyName): ChainedValidator&Validator;

    public static function propertySubdivisionCode(
        string $propertyName,
        string $countryCode,
    ): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public static function propertySubset(string $propertyName, array $superset): ChainedValidator&Validator;

    public static function propertySymbolicLink(string $propertyName): ChainedValidator&Validator;

    public static function propertyTime(string $propertyName, string $format = 'H:i:s'): ChainedValidator&Validator;

    public static function propertyTld(string $propertyName): ChainedValidator&Validator;

    public static function propertyTrueVal(string $propertyName): ChainedValidator&Validator;

    public static function propertyUnique(string $propertyName): ChainedValidator&Validator;

    public static function propertyUploaded(string $propertyName): ChainedValidator&Validator;

    public static function propertyUppercase(string $propertyName): ChainedValidator&Validator;

    public static function propertyUrl(string $propertyName): ChainedValidator&Validator;

    public static function propertyUuid(string $propertyName, ?int $version = null): ChainedValidator&Validator;

    public static function propertyVersion(string $propertyName): ChainedValidator&Validator;

    public static function propertyVideoUrl(string $propertyName, ?string $service = null): ChainedValidator&Validator;

    public static function propertyVowel(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public static function propertyWhen(
        string $propertyName,
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator&Validator;

    public static function propertyWritable(string $propertyName): ChainedValidator&Validator;

    public static function propertyXdigit(
        string $propertyName,
        string ...$additionalChars,
    ): ChainedValidator&Validator;

    public static function propertyYes(string $propertyName, bool $useLocale = false): ChainedValidator&Validator;
}
