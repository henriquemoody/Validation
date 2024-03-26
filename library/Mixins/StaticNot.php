<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface StaticNot
{
    public static function notAllOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function notAlnum(string ...$additionalChars): ChainedValidator&Validator;

    public static function notAlpha(string ...$additionalChars): ChainedValidator&Validator;

    public static function notAlwaysInvalid(): ChainedValidator&Validator;

    public static function notAlwaysValid(): ChainedValidator&Validator;

    public static function notAnyOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function notArrayType(): ChainedValidator&Validator;

    public static function notArrayVal(): ChainedValidator&Validator;

    public static function notBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public static function notBase64(): ChainedValidator&Validator;

    public static function notBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public static function notBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public static function notBoolType(): ChainedValidator&Validator;

    public static function notBoolVal(): ChainedValidator&Validator;

    public static function notBsn(): ChainedValidator&Validator;

    public static function notCall(callable $callable, Validatable $rule): ChainedValidator&Validator;

    public static function notCallableType(): ChainedValidator&Validator;

    public static function notCallback(callable $callback, mixed ...$arguments): ChainedValidator&Validator;

    public static function notCharset(string $charset, string ...$charsets): ChainedValidator&Validator;

    public static function notCnh(): ChainedValidator&Validator;

    public static function notCnpj(): ChainedValidator&Validator;

    public static function notConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function notConsonant(string ...$additionalChars): ChainedValidator&Validator;

    public static function notContains(mixed $containsValue, bool $identical = false): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function notContainsAny(array $needles, bool $identical = false): ChainedValidator&Validator;

    public static function notControl(string ...$additionalChars): ChainedValidator&Validator;

    public static function notCountable(): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function notCountryCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    public static function notCpf(): ChainedValidator&Validator;

    public static function notCreditCard(string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function notCurrencyCode(string $set = 'alpha-3'): ChainedValidator&Validator;

    public static function notDate(string $format = 'Y-m-d'): ChainedValidator&Validator;

    public static function notDateTime(?string $format = null): ChainedValidator&Validator;

    public static function notDecimal(int $decimals): ChainedValidator&Validator;

    public static function notDigit(string ...$additionalChars): ChainedValidator&Validator;

    public static function notDirectory(): ChainedValidator&Validator;

    public static function notDomain(bool $tldCheck = true): ChainedValidator&Validator;

    public static function notEach(Validatable $rule): ChainedValidator&Validator;

    public static function notEmail(): ChainedValidator&Validator;

    public static function notEndsWith(mixed $endValue, bool $identical = false): ChainedValidator&Validator;

    public static function notEquals(mixed $compareTo): ChainedValidator&Validator;

    public static function notEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public static function notEven(): ChainedValidator&Validator;

    public static function notExecutable(): ChainedValidator&Validator;

    public static function notExists(): ChainedValidator&Validator;

    public static function notExtension(string $extension): ChainedValidator&Validator;

    public static function notFactor(int $dividend): ChainedValidator&Validator;

    public static function notFalseVal(): ChainedValidator&Validator;

    public static function notFibonacci(): ChainedValidator&Validator;

    public static function notFile(): ChainedValidator&Validator;

    public static function notFilterVar(int $filter, mixed $options = null): ChainedValidator&Validator;

    public static function notFinite(): ChainedValidator&Validator;

    public static function notFloatType(): ChainedValidator&Validator;

    public static function notFloatVal(): ChainedValidator&Validator;

    public static function notGraph(string ...$additionalChars): ChainedValidator&Validator;

    public static function notGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public static function notGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function notHetu(): ChainedValidator&Validator;

    public static function notHexRgbColor(): ChainedValidator&Validator;

    public static function notIban(): ChainedValidator&Validator;

    public static function notIdentical(mixed $compareTo): ChainedValidator&Validator;

    public static function notImage(): ChainedValidator&Validator;

    public static function notImei(): ChainedValidator&Validator;

    public static function notIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public static function notInfinite(): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public static function notInstance(string $class): ChainedValidator&Validator;

    public static function notIntType(): ChainedValidator&Validator;

    public static function notIntVal(): ChainedValidator&Validator;

    public static function notIp(string $range = '*', ?int $options = null): ChainedValidator&Validator;

    public static function notIsbn(): ChainedValidator&Validator;

    public static function notIterableType(): ChainedValidator&Validator;

    public static function notIterableVal(): ChainedValidator&Validator;

    public static function notJson(): ChainedValidator&Validator;

    public static function notKey(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public static function notKeyExists(string|int $key): ChainedValidator&Validator;

    public static function notKeyOptional(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public static function notKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function notLanguageCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function notLazy(callable $ruleCreator): ChainedValidator&Validator;

    public static function notLeapDate(string $format): ChainedValidator&Validator;

    public static function notLeapYear(): ChainedValidator&Validator;

    public static function notLength(Validatable $rule): ChainedValidator&Validator;

    public static function notLessThan(mixed $compareTo): ChainedValidator&Validator;

    public static function notLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function notLowercase(): ChainedValidator&Validator;

    public static function notLuhn(): ChainedValidator&Validator;

    public static function notMacAddress(): ChainedValidator&Validator;

    public static function notMax(Validatable $rule): ChainedValidator&Validator;

    public static function notMaxAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public static function notMimetype(string $mimetype): ChainedValidator&Validator;

    public static function notMin(Validatable $rule): ChainedValidator&Validator;

    public static function notMinAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public static function notMultiple(int $multipleOf): ChainedValidator&Validator;

    public static function notNegative(): ChainedValidator&Validator;

    public static function notNfeAccessKey(): ChainedValidator&Validator;

    public static function notNif(): ChainedValidator&Validator;

    public static function notNip(): ChainedValidator&Validator;

    public static function notNo(bool $useLocale = false): ChainedValidator&Validator;

    public static function notNoWhitespace(): ChainedValidator&Validator;

    public static function notNoneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function notNullType(): ChainedValidator&Validator;

    public static function notNumber(): ChainedValidator&Validator;

    public static function notNumericVal(): ChainedValidator&Validator;

    public static function notObjectType(): ChainedValidator&Validator;

    public static function notOdd(): ChainedValidator&Validator;

    public static function notOneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function notPerfectSquare(): ChainedValidator&Validator;

    public static function notPesel(): ChainedValidator&Validator;

    public static function notPhone(?string $countryCode = null): ChainedValidator&Validator;

    public static function notPhpLabel(): ChainedValidator&Validator;

    public static function notPis(): ChainedValidator&Validator;

    public static function notPolishIdCard(): ChainedValidator&Validator;

    public static function notPortugueseNif(): ChainedValidator&Validator;

    public static function notPositive(): ChainedValidator&Validator;

    public static function notPostalCode(string $countryCode, bool $formatted = false): ChainedValidator&Validator;

    public static function notPrimeNumber(): ChainedValidator&Validator;

    public static function notPrintable(string ...$additionalChars): ChainedValidator&Validator;

    public static function notProperty(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function notPropertyExists(string $propertyName): ChainedValidator&Validator;

    public static function notPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function notPublicDomainSuffix(): ChainedValidator&Validator;

    public static function notPunct(string ...$additionalChars): ChainedValidator&Validator;

    public static function notReadable(): ChainedValidator&Validator;

    public static function notRegex(string $regex): ChainedValidator&Validator;

    public static function notResourceType(): ChainedValidator&Validator;

    public static function notRoman(): ChainedValidator&Validator;

    public static function notScalarVal(): ChainedValidator&Validator;

    public static function notSize(
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator&Validator;

    public static function notSlug(): ChainedValidator&Validator;

    public static function notSorted(string $direction): ChainedValidator&Validator;

    public static function notSpace(string ...$additionalChars): ChainedValidator&Validator;

    public static function notStartsWith(mixed $startValue, bool $identical = false): ChainedValidator&Validator;

    public static function notStringType(): ChainedValidator&Validator;

    public static function notStringVal(): ChainedValidator&Validator;

    public static function notSubdivisionCode(string $countryCode): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public static function notSubset(array $superset): ChainedValidator&Validator;

    public static function notSymbolicLink(): ChainedValidator&Validator;

    public static function notTime(string $format = 'H:i:s'): ChainedValidator&Validator;

    public static function notTld(): ChainedValidator&Validator;

    public static function notTrueVal(): ChainedValidator&Validator;

    public static function notUnique(): ChainedValidator&Validator;

    public static function notUploaded(): ChainedValidator&Validator;

    public static function notUppercase(): ChainedValidator&Validator;

    public static function notUrl(): ChainedValidator&Validator;

    public static function notUuid(?int $version = null): ChainedValidator&Validator;

    public static function notVersion(): ChainedValidator&Validator;

    public static function notVideoUrl(?string $service = null): ChainedValidator&Validator;

    public static function notVowel(string ...$additionalChars): ChainedValidator&Validator;

    public static function notWhen(
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator&Validator;

    public static function notWritable(): ChainedValidator&Validator;

    public static function notXdigit(string ...$additionalChars): ChainedValidator&Validator;

    public static function notYes(bool $useLocale = false): ChainedValidator&Validator;
}
