<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface ChainedKey
{
    public function keyAllOf(
        int|string $key,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function keyAlnum(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyAlpha(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyAlwaysInvalid(int|string $key): ChainedValidator&Validator;

    public function keyAlwaysValid(int|string $key): ChainedValidator&Validator;

    public function keyAnyOf(
        int|string $key,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function keyArrayType(int|string $key): ChainedValidator&Validator;

    public function keyArrayVal(int|string $key): ChainedValidator&Validator;

    public function keyBase(
        int|string $key,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public function keyBase64(int|string $key): ChainedValidator&Validator;

    public function keyBetween(int|string $key, mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public function keyBetweenExclusive(int|string $key, mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public function keyBoolType(int|string $key): ChainedValidator&Validator;

    public function keyBoolVal(int|string $key): ChainedValidator&Validator;

    public function keyBsn(int|string $key): ChainedValidator&Validator;

    public function keyCall(int|string $key, callable $callable, Validatable $rule): ChainedValidator&Validator;

    public function keyCallableType(int|string $key): ChainedValidator&Validator;

    public function keyCallback(int|string $key, callable $callback, mixed ...$arguments): ChainedValidator&Validator;

    public function keyCharset(int|string $key, string $charset, string ...$charsets): ChainedValidator&Validator;

    public function keyCnh(int|string $key): ChainedValidator&Validator;

    public function keyCnpj(int|string $key): ChainedValidator&Validator;

    public function keyConsecutive(
        int|string $key,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function keyConsonant(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyContains(
        int|string $key,
        mixed $containsValue,
        bool $identical = false,
    ): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function keyContainsAny(
        int|string $key,
        array $needles,
        bool $identical = false,
    ): ChainedValidator&Validator;

    public function keyControl(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyCountable(int|string $key): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function keyCountryCode(int|string $key, string $set = 'alpha-2'): ChainedValidator&Validator;

    public function keyCpf(int|string $key): ChainedValidator&Validator;

    public function keyCreditCard(int|string $key, string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function keyCurrencyCode(int|string $key, string $set = 'alpha-3'): ChainedValidator&Validator;

    public function keyDate(int|string $key, string $format = 'Y-m-d'): ChainedValidator&Validator;

    public function keyDateTime(int|string $key, ?string $format = null): ChainedValidator&Validator;

    public function keyDecimal(int|string $key, int $decimals): ChainedValidator&Validator;

    public function keyDigit(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyDirectory(int|string $key): ChainedValidator&Validator;

    public function keyDomain(int|string $key, bool $tldCheck = true): ChainedValidator&Validator;

    public function keyEach(int|string $key, Validatable $rule): ChainedValidator&Validator;

    public function keyEmail(int|string $key): ChainedValidator&Validator;

    public function keyEndsWith(int|string $key, mixed $endValue, bool $identical = false): ChainedValidator&Validator;

    public function keyEquals(int|string $key, mixed $compareTo): ChainedValidator&Validator;

    public function keyEquivalent(int|string $key, mixed $compareTo): ChainedValidator&Validator;

    public function keyEven(int|string $key): ChainedValidator&Validator;

    public function keyExecutable(int|string $key): ChainedValidator&Validator;

    public function keyExtension(int|string $key, string $extension): ChainedValidator&Validator;

    public function keyFactor(int|string $key, int $dividend): ChainedValidator&Validator;

    public function keyFalseVal(int|string $key): ChainedValidator&Validator;

    public function keyFibonacci(int|string $key): ChainedValidator&Validator;

    public function keyFile(int|string $key): ChainedValidator&Validator;

    public function keyFilterVar(int|string $key, int $filter, mixed $options = null): ChainedValidator&Validator;

    public function keyFinite(int|string $key): ChainedValidator&Validator;

    public function keyFloatType(int|string $key): ChainedValidator&Validator;

    public function keyFloatVal(int|string $key): ChainedValidator&Validator;

    public function keyGraph(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyGreaterThan(int|string $key, mixed $compareTo): ChainedValidator&Validator;

    public function keyGreaterThanOrEqual(int|string $key, mixed $compareTo): ChainedValidator&Validator;

    public function keyHetu(int|string $key): ChainedValidator&Validator;

    public function keyHexRgbColor(int|string $key): ChainedValidator&Validator;

    public function keyIban(int|string $key): ChainedValidator&Validator;

    public function keyIdentical(int|string $key, mixed $compareTo): ChainedValidator&Validator;

    public function keyImage(int|string $key): ChainedValidator&Validator;

    public function keyImei(int|string $key): ChainedValidator&Validator;

    public function keyIn(
        int|string $key,
        mixed $haystack,
        bool $compareIdentical = false,
    ): ChainedValidator&Validator;

    public function keyInfinite(int|string $key): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public function keyInstance(int|string $key, string $class): ChainedValidator&Validator;

    public function keyIntType(int|string $key): ChainedValidator&Validator;

    public function keyIntVal(int|string $key): ChainedValidator&Validator;

    public function keyIp(int|string $key, string $range = '*', ?int $options = null): ChainedValidator&Validator;

    public function keyIsbn(int|string $key): ChainedValidator&Validator;

    public function keyIterableType(int|string $key): ChainedValidator&Validator;

    public function keyIterableVal(int|string $key): ChainedValidator&Validator;

    public function keyJson(int|string $key): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function keyLanguageCode(int|string $key, string $set = 'alpha-2'): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function keyLazy(int|string $key, callable $ruleCreator): ChainedValidator&Validator;

    public function keyLeapDate(int|string $key, string $format): ChainedValidator&Validator;

    public function keyLeapYear(int|string $key): ChainedValidator&Validator;

    public function keyLength(int|string $key, Validatable $rule): ChainedValidator&Validator;

    public function keyLessThan(int|string $key, mixed $compareTo): ChainedValidator&Validator;

    public function keyLessThanOrEqual(int|string $key, mixed $compareTo): ChainedValidator&Validator;

    public function keyLowercase(int|string $key): ChainedValidator&Validator;

    public function keyLuhn(int|string $key): ChainedValidator&Validator;

    public function keyMacAddress(int|string $key): ChainedValidator&Validator;

    public function keyMax(int|string $key, Validatable $rule): ChainedValidator&Validator;

    public function keyMaxAge(int|string $key, int $age, ?string $format = null): ChainedValidator&Validator;

    public function keyMimetype(int|string $key, string $mimetype): ChainedValidator&Validator;

    public function keyMin(int|string $key, Validatable $rule): ChainedValidator&Validator;

    public function keyMinAge(int|string $key, int $age, ?string $format = null): ChainedValidator&Validator;

    public function keyMultiple(int|string $key, int $multipleOf): ChainedValidator&Validator;

    public function keyNegative(int|string $key): ChainedValidator&Validator;

    public function keyNfeAccessKey(int|string $key): ChainedValidator&Validator;

    public function keyNif(int|string $key): ChainedValidator&Validator;

    public function keyNip(int|string $key): ChainedValidator&Validator;

    public function keyNo(int|string $key, bool $useLocale = false): ChainedValidator&Validator;

    public function keyNoWhitespace(int|string $key): ChainedValidator&Validator;

    public function keyNoneOf(
        int|string $key,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function keyNot(int|string $key, Validatable $rule): ChainedValidator&Validator;

    public function keyNotBlank(int|string $key): ChainedValidator&Validator;

    public function keyNotEmoji(int|string $key): ChainedValidator&Validator;

    public function keyNotEmpty(int|string $key): ChainedValidator&Validator;

    public function keyNotOptional(int|string $key): ChainedValidator&Validator;

    public function keyNullType(int|string $key): ChainedValidator&Validator;

    public function keyNumber(int|string $key): ChainedValidator&Validator;

    public function keyNumericVal(int|string $key): ChainedValidator&Validator;

    public function keyObjectType(int|string $key): ChainedValidator&Validator;

    public function keyOdd(int|string $key): ChainedValidator&Validator;

    public function keyOneOf(
        int|string $key,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function keyPerfectSquare(int|string $key): ChainedValidator&Validator;

    public function keyPesel(int|string $key): ChainedValidator&Validator;

    public function keyPhone(int|string $key, ?string $countryCode = null): ChainedValidator&Validator;

    public function keyPhpLabel(int|string $key): ChainedValidator&Validator;

    public function keyPis(int|string $key): ChainedValidator&Validator;

    public function keyPolishIdCard(int|string $key): ChainedValidator&Validator;

    public function keyPortugueseNif(int|string $key): ChainedValidator&Validator;

    public function keyPositive(int|string $key): ChainedValidator&Validator;

    public function keyPostalCode(
        int|string $key,
        string $countryCode,
        bool $formatted = false,
    ): ChainedValidator&Validator;

    public function keyPrimeNumber(int|string $key): ChainedValidator&Validator;

    public function keyPrintable(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyPublicDomainSuffix(int|string $key): ChainedValidator&Validator;

    public function keyPunct(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyReadable(int|string $key): ChainedValidator&Validator;

    public function keyRegex(int|string $key, string $regex): ChainedValidator&Validator;

    public function keyResourceType(int|string $key): ChainedValidator&Validator;

    public function keyRoman(int|string $key): ChainedValidator&Validator;

    public function keyScalarVal(int|string $key): ChainedValidator&Validator;

    public function keySize(
        int|string $key,
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator&Validator;

    public function keySlug(int|string $key): ChainedValidator&Validator;

    public function keySorted(int|string $key, string $direction): ChainedValidator&Validator;

    public function keySpace(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyStartsWith(
        int|string $key,
        mixed $startValue,
        bool $identical = false,
    ): ChainedValidator&Validator;

    public function keyStringType(int|string $key): ChainedValidator&Validator;

    public function keyStringVal(int|string $key): ChainedValidator&Validator;

    public function keySubdivisionCode(int|string $key, string $countryCode): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public function keySubset(int|string $key, array $superset): ChainedValidator&Validator;

    public function keySymbolicLink(int|string $key): ChainedValidator&Validator;

    public function keyTime(int|string $key, string $format = 'H:i:s'): ChainedValidator&Validator;

    public function keyTld(int|string $key): ChainedValidator&Validator;

    public function keyTrueVal(int|string $key): ChainedValidator&Validator;

    public function keyUnique(int|string $key): ChainedValidator&Validator;

    public function keyUploaded(int|string $key): ChainedValidator&Validator;

    public function keyUppercase(int|string $key): ChainedValidator&Validator;

    public function keyUrl(int|string $key): ChainedValidator&Validator;

    public function keyUuid(int|string $key, ?int $version = null): ChainedValidator&Validator;

    public function keyVersion(int|string $key): ChainedValidator&Validator;

    public function keyVideoUrl(int|string $key, ?string $service = null): ChainedValidator&Validator;

    public function keyVowel(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyWhen(
        int|string $key,
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator&Validator;

    public function keyWritable(int|string $key): ChainedValidator&Validator;

    public function keyXdigit(int|string $key, string ...$additionalChars): ChainedValidator&Validator;

    public function keyYes(int|string $key, bool $useLocale = false): ChainedValidator&Validator;
}
