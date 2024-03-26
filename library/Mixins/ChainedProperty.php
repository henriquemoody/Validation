<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface ChainedProperty
{
    public function propertyAllOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function propertyAlnum(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyAlpha(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyAlwaysInvalid(string $propertyName): ChainedValidator&Validator;

    public function propertyAlwaysValid(string $propertyName): ChainedValidator&Validator;

    public function propertyAnyOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function propertyArrayType(string $propertyName): ChainedValidator&Validator;

    public function propertyArrayVal(string $propertyName): ChainedValidator&Validator;

    public function propertyBase(
        string $propertyName,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public function propertyBase64(string $propertyName): ChainedValidator&Validator;

    public function propertyBetween(
        string $propertyName,
        mixed $minValue,
        mixed $maxValue,
    ): ChainedValidator&Validator;

    public function propertyBetweenExclusive(
        string $propertyName,
        mixed $minimum,
        mixed $maximum,
    ): ChainedValidator&Validator;

    public function propertyBoolType(string $propertyName): ChainedValidator&Validator;

    public function propertyBoolVal(string $propertyName): ChainedValidator&Validator;

    public function propertyBsn(string $propertyName): ChainedValidator&Validator;

    public function propertyCall(
        string $propertyName,
        callable $callable,
        Validatable $rule,
    ): ChainedValidator&Validator;

    public function propertyCallableType(string $propertyName): ChainedValidator&Validator;

    public function propertyCallback(
        string $propertyName,
        callable $callback,
        mixed ...$arguments,
    ): ChainedValidator&Validator;

    public function propertyCharset(
        string $propertyName,
        string $charset,
        string ...$charsets,
    ): ChainedValidator&Validator;

    public function propertyCnh(string $propertyName): ChainedValidator&Validator;

    public function propertyCnpj(string $propertyName): ChainedValidator&Validator;

    public function propertyConsecutive(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function propertyConsonant(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyContains(
        string $propertyName,
        mixed $containsValue,
        bool $identical = false,
    ): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function propertyContainsAny(
        string $propertyName,
        array $needles,
        bool $identical = false,
    ): ChainedValidator&Validator;

    public function propertyControl(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyCountable(string $propertyName): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function propertyCountryCode(string $propertyName, string $set = 'alpha-2'): ChainedValidator&Validator;

    public function propertyCpf(string $propertyName): ChainedValidator&Validator;

    public function propertyCreditCard(string $propertyName, string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function propertyCurrencyCode(string $propertyName, string $set = 'alpha-3'): ChainedValidator&Validator;

    public function propertyDate(string $propertyName, string $format = 'Y-m-d'): ChainedValidator&Validator;

    public function propertyDateTime(string $propertyName, ?string $format = null): ChainedValidator&Validator;

    public function propertyDecimal(string $propertyName, int $decimals): ChainedValidator&Validator;

    public function propertyDigit(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyDirectory(string $propertyName): ChainedValidator&Validator;

    public function propertyDomain(string $propertyName, bool $tldCheck = true): ChainedValidator&Validator;

    public function propertyEach(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function propertyEmail(string $propertyName): ChainedValidator&Validator;

    public function propertyEndsWith(
        string $propertyName,
        mixed $endValue,
        bool $identical = false,
    ): ChainedValidator&Validator;

    public function propertyEquals(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public function propertyEquivalent(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public function propertyEven(string $propertyName): ChainedValidator&Validator;

    public function propertyExecutable(string $propertyName): ChainedValidator&Validator;

    public function propertyExtension(string $propertyName, string $extension): ChainedValidator&Validator;

    public function propertyFactor(string $propertyName, int $dividend): ChainedValidator&Validator;

    public function propertyFalseVal(string $propertyName): ChainedValidator&Validator;

    public function propertyFibonacci(string $propertyName): ChainedValidator&Validator;

    public function propertyFile(string $propertyName): ChainedValidator&Validator;

    public function propertyFilterVar(
        string $propertyName,
        int $filter,
        mixed $options = null,
    ): ChainedValidator&Validator;

    public function propertyFinite(string $propertyName): ChainedValidator&Validator;

    public function propertyFloatType(string $propertyName): ChainedValidator&Validator;

    public function propertyFloatVal(string $propertyName): ChainedValidator&Validator;

    public function propertyGraph(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyGreaterThan(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public function propertyGreaterThanOrEqual(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public function propertyHetu(string $propertyName): ChainedValidator&Validator;

    public function propertyHexRgbColor(string $propertyName): ChainedValidator&Validator;

    public function propertyIban(string $propertyName): ChainedValidator&Validator;

    public function propertyIdentical(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public function propertyImage(string $propertyName): ChainedValidator&Validator;

    public function propertyImei(string $propertyName): ChainedValidator&Validator;

    public function propertyIn(
        string $propertyName,
        mixed $haystack,
        bool $compareIdentical = false,
    ): ChainedValidator&Validator;

    public function propertyInfinite(string $propertyName): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public function propertyInstance(string $propertyName, string $class): ChainedValidator&Validator;

    public function propertyIntType(string $propertyName): ChainedValidator&Validator;

    public function propertyIntVal(string $propertyName): ChainedValidator&Validator;

    public function propertyIp(
        string $propertyName,
        string $range = '*',
        ?int $options = null,
    ): ChainedValidator&Validator;

    public function propertyIsbn(string $propertyName): ChainedValidator&Validator;

    public function propertyIterableType(string $propertyName): ChainedValidator&Validator;

    public function propertyIterableVal(string $propertyName): ChainedValidator&Validator;

    public function propertyJson(string $propertyName): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function propertyLanguageCode(string $propertyName, string $set = 'alpha-2'): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function propertyLazy(string $propertyName, callable $ruleCreator): ChainedValidator&Validator;

    public function propertyLeapDate(string $propertyName, string $format): ChainedValidator&Validator;

    public function propertyLeapYear(string $propertyName): ChainedValidator&Validator;

    public function propertyLength(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function propertyLessThan(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public function propertyLessThanOrEqual(string $propertyName, mixed $compareTo): ChainedValidator&Validator;

    public function propertyLowercase(string $propertyName): ChainedValidator&Validator;

    public function propertyLuhn(string $propertyName): ChainedValidator&Validator;

    public function propertyMacAddress(string $propertyName): ChainedValidator&Validator;

    public function propertyMax(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function propertyMaxAge(string $propertyName, int $age, ?string $format = null): ChainedValidator&Validator;

    public function propertyMimetype(string $propertyName, string $mimetype): ChainedValidator&Validator;

    public function propertyMin(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function propertyMinAge(string $propertyName, int $age, ?string $format = null): ChainedValidator&Validator;

    public function propertyMultiple(string $propertyName, int $multipleOf): ChainedValidator&Validator;

    public function propertyNegative(string $propertyName): ChainedValidator&Validator;

    public function propertyNfeAccessKey(string $propertyName): ChainedValidator&Validator;

    public function propertyNif(string $propertyName): ChainedValidator&Validator;

    public function propertyNip(string $propertyName): ChainedValidator&Validator;

    public function propertyNo(string $propertyName, bool $useLocale = false): ChainedValidator&Validator;

    public function propertyNoWhitespace(string $propertyName): ChainedValidator&Validator;

    public function propertyNoneOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function propertyNot(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function propertyNotBlank(string $propertyName): ChainedValidator&Validator;

    public function propertyNotEmoji(string $propertyName): ChainedValidator&Validator;

    public function propertyNotEmpty(string $propertyName): ChainedValidator&Validator;

    public function propertyNotOptional(string $propertyName): ChainedValidator&Validator;

    public function propertyNullType(string $propertyName): ChainedValidator&Validator;

    public function propertyNumber(string $propertyName): ChainedValidator&Validator;

    public function propertyNumericVal(string $propertyName): ChainedValidator&Validator;

    public function propertyObjectType(string $propertyName): ChainedValidator&Validator;

    public function propertyOdd(string $propertyName): ChainedValidator&Validator;

    public function propertyOneOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function propertyPerfectSquare(string $propertyName): ChainedValidator&Validator;

    public function propertyPesel(string $propertyName): ChainedValidator&Validator;

    public function propertyPhone(string $propertyName, ?string $countryCode = null): ChainedValidator&Validator;

    public function propertyPhpLabel(string $propertyName): ChainedValidator&Validator;

    public function propertyPis(string $propertyName): ChainedValidator&Validator;

    public function propertyPolishIdCard(string $propertyName): ChainedValidator&Validator;

    public function propertyPortugueseNif(string $propertyName): ChainedValidator&Validator;

    public function propertyPositive(string $propertyName): ChainedValidator&Validator;

    public function propertyPostalCode(
        string $propertyName,
        string $countryCode,
        bool $formatted = false,
    ): ChainedValidator&Validator;

    public function propertyPrimeNumber(string $propertyName): ChainedValidator&Validator;

    public function propertyPrintable(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyPublicDomainSuffix(string $propertyName): ChainedValidator&Validator;

    public function propertyPunct(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyReadable(string $propertyName): ChainedValidator&Validator;

    public function propertyRegex(string $propertyName, string $regex): ChainedValidator&Validator;

    public function propertyResourceType(string $propertyName): ChainedValidator&Validator;

    public function propertyRoman(string $propertyName): ChainedValidator&Validator;

    public function propertyScalarVal(string $propertyName): ChainedValidator&Validator;

    public function propertySize(
        string $propertyName,
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator&Validator;

    public function propertySlug(string $propertyName): ChainedValidator&Validator;

    public function propertySorted(string $propertyName, string $direction): ChainedValidator&Validator;

    public function propertySpace(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyStartsWith(
        string $propertyName,
        mixed $startValue,
        bool $identical = false,
    ): ChainedValidator&Validator;

    public function propertyStringType(string $propertyName): ChainedValidator&Validator;

    public function propertyStringVal(string $propertyName): ChainedValidator&Validator;

    public function propertySubdivisionCode(string $propertyName, string $countryCode): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public function propertySubset(string $propertyName, array $superset): ChainedValidator&Validator;

    public function propertySymbolicLink(string $propertyName): ChainedValidator&Validator;

    public function propertyTime(string $propertyName, string $format = 'H:i:s'): ChainedValidator&Validator;

    public function propertyTld(string $propertyName): ChainedValidator&Validator;

    public function propertyTrueVal(string $propertyName): ChainedValidator&Validator;

    public function propertyUnique(string $propertyName): ChainedValidator&Validator;

    public function propertyUploaded(string $propertyName): ChainedValidator&Validator;

    public function propertyUppercase(string $propertyName): ChainedValidator&Validator;

    public function propertyUrl(string $propertyName): ChainedValidator&Validator;

    public function propertyUuid(string $propertyName, ?int $version = null): ChainedValidator&Validator;

    public function propertyVersion(string $propertyName): ChainedValidator&Validator;

    public function propertyVideoUrl(string $propertyName, ?string $service = null): ChainedValidator&Validator;

    public function propertyVowel(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyWhen(
        string $propertyName,
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator&Validator;

    public function propertyWritable(string $propertyName): ChainedValidator&Validator;

    public function propertyXdigit(string $propertyName, string ...$additionalChars): ChainedValidator&Validator;

    public function propertyYes(string $propertyName, bool $useLocale = false): ChainedValidator&Validator;
}
