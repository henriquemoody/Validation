<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface ChainedNot
{
    public function notAllOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function notAlnum(string ...$additionalChars): ChainedValidator&Validator;

    public function notAlpha(string ...$additionalChars): ChainedValidator&Validator;

    public function notAlwaysInvalid(): ChainedValidator&Validator;

    public function notAlwaysValid(): ChainedValidator&Validator;

    public function notAnyOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function notArrayType(): ChainedValidator&Validator;

    public function notArrayVal(): ChainedValidator&Validator;

    public function notBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public function notBase64(): ChainedValidator&Validator;

    public function notBetween(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public function notBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public function notBoolType(): ChainedValidator&Validator;

    public function notBoolVal(): ChainedValidator&Validator;

    public function notBsn(): ChainedValidator&Validator;

    public function notCall(callable $callable, Validatable $rule): ChainedValidator&Validator;

    public function notCallableType(): ChainedValidator&Validator;

    public function notCallback(callable $callback, mixed ...$arguments): ChainedValidator&Validator;

    public function notCharset(string $charset, string ...$charsets): ChainedValidator&Validator;

    public function notCnh(): ChainedValidator&Validator;

    public function notCnpj(): ChainedValidator&Validator;

    public function notConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function notConsonant(string ...$additionalChars): ChainedValidator&Validator;

    public function notContains(mixed $containsValue, bool $identical = false): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function notContainsAny(array $needles, bool $identical = false): ChainedValidator&Validator;

    public function notControl(string ...$additionalChars): ChainedValidator&Validator;

    public function notCountable(): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function notCountryCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    public function notCpf(): ChainedValidator&Validator;

    public function notCreditCard(string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function notCurrencyCode(string $set = 'alpha-3'): ChainedValidator&Validator;

    public function notDate(string $format = 'Y-m-d'): ChainedValidator&Validator;

    public function notDateTime(?string $format = null): ChainedValidator&Validator;

    public function notDecimal(int $decimals): ChainedValidator&Validator;

    public function notDigit(string ...$additionalChars): ChainedValidator&Validator;

    public function notDirectory(): ChainedValidator&Validator;

    public function notDomain(bool $tldCheck = true): ChainedValidator&Validator;

    public function notEach(Validatable $rule): ChainedValidator&Validator;

    public function notEmail(): ChainedValidator&Validator;

    public function notEndsWith(mixed $endValue, bool $identical = false): ChainedValidator&Validator;

    public function notEquals(mixed $compareTo): ChainedValidator&Validator;

    public function notEquivalent(mixed $compareTo): ChainedValidator&Validator;

    public function notEven(): ChainedValidator&Validator;

    public function notExecutable(): ChainedValidator&Validator;

    public function notExists(): ChainedValidator&Validator;

    public function notExtension(string $extension): ChainedValidator&Validator;

    public function notFactor(int $dividend): ChainedValidator&Validator;

    public function notFalseVal(): ChainedValidator&Validator;

    public function notFibonacci(): ChainedValidator&Validator;

    public function notFile(): ChainedValidator&Validator;

    public function notFilterVar(int $filter, mixed $options = null): ChainedValidator&Validator;

    public function notFinite(): ChainedValidator&Validator;

    public function notFloatType(): ChainedValidator&Validator;

    public function notFloatVal(): ChainedValidator&Validator;

    public function notGraph(string ...$additionalChars): ChainedValidator&Validator;

    public function notGreaterThan(mixed $compareTo): ChainedValidator&Validator;

    public function notGreaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function notHetu(): ChainedValidator&Validator;

    public function notHexRgbColor(): ChainedValidator&Validator;

    public function notIban(): ChainedValidator&Validator;

    public function notIdentical(mixed $compareTo): ChainedValidator&Validator;

    public function notImage(): ChainedValidator&Validator;

    public function notImei(): ChainedValidator&Validator;

    public function notIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public function notInfinite(): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public function notInstance(string $class): ChainedValidator&Validator;

    public function notIntType(): ChainedValidator&Validator;

    public function notIntVal(): ChainedValidator&Validator;

    public function notIp(string $range = '*', ?int $options = null): ChainedValidator&Validator;

    public function notIsbn(): ChainedValidator&Validator;

    public function notIterableType(): ChainedValidator&Validator;

    public function notIterableVal(): ChainedValidator&Validator;

    public function notJson(): ChainedValidator&Validator;

    public function notKey(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public function notKeyExists(string|int $key): ChainedValidator&Validator;

    public function notKeyOptional(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public function notKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function notLanguageCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function notLazy(callable $ruleCreator): ChainedValidator&Validator;

    public function notLeapDate(string $format): ChainedValidator&Validator;

    public function notLeapYear(): ChainedValidator&Validator;

    public function notLength(Validatable $rule): ChainedValidator&Validator;

    public function notLessThan(mixed $compareTo): ChainedValidator&Validator;

    public function notLessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function notLowercase(): ChainedValidator&Validator;

    public function notLuhn(): ChainedValidator&Validator;

    public function notMacAddress(): ChainedValidator&Validator;

    public function notMax(Validatable $rule): ChainedValidator&Validator;

    public function notMaxAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public function notMimetype(string $mimetype): ChainedValidator&Validator;

    public function notMin(Validatable $rule): ChainedValidator&Validator;

    public function notMinAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public function notMultiple(int $multipleOf): ChainedValidator&Validator;

    public function notNegative(): ChainedValidator&Validator;

    public function notNfeAccessKey(): ChainedValidator&Validator;

    public function notNif(): ChainedValidator&Validator;

    public function notNip(): ChainedValidator&Validator;

    public function notNo(bool $useLocale = false): ChainedValidator&Validator;

    public function notNoWhitespace(): ChainedValidator&Validator;

    public function notNoneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function notNullType(): ChainedValidator&Validator;

    public function notNumber(): ChainedValidator&Validator;

    public function notNumericVal(): ChainedValidator&Validator;

    public function notObjectType(): ChainedValidator&Validator;

    public function notOdd(): ChainedValidator&Validator;

    public function notOneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function notPerfectSquare(): ChainedValidator&Validator;

    public function notPesel(): ChainedValidator&Validator;

    public function notPhone(?string $countryCode = null): ChainedValidator&Validator;

    public function notPhpLabel(): ChainedValidator&Validator;

    public function notPis(): ChainedValidator&Validator;

    public function notPolishIdCard(): ChainedValidator&Validator;

    public function notPortugueseNif(): ChainedValidator&Validator;

    public function notPositive(): ChainedValidator&Validator;

    public function notPostalCode(string $countryCode, bool $formatted = false): ChainedValidator&Validator;

    public function notPrimeNumber(): ChainedValidator&Validator;

    public function notPrintable(string ...$additionalChars): ChainedValidator&Validator;

    public function notProperty(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function notPropertyExists(string $propertyName): ChainedValidator&Validator;

    public function notPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function notPublicDomainSuffix(): ChainedValidator&Validator;

    public function notPunct(string ...$additionalChars): ChainedValidator&Validator;

    public function notReadable(): ChainedValidator&Validator;

    public function notRegex(string $regex): ChainedValidator&Validator;

    public function notResourceType(): ChainedValidator&Validator;

    public function notRoman(): ChainedValidator&Validator;

    public function notScalarVal(): ChainedValidator&Validator;

    public function notSize(
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator&Validator;

    public function notSlug(): ChainedValidator&Validator;

    public function notSorted(string $direction): ChainedValidator&Validator;

    public function notSpace(string ...$additionalChars): ChainedValidator&Validator;

    public function notStartsWith(mixed $startValue, bool $identical = false): ChainedValidator&Validator;

    public function notStringType(): ChainedValidator&Validator;

    public function notStringVal(): ChainedValidator&Validator;

    public function notSubdivisionCode(string $countryCode): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public function notSubset(array $superset): ChainedValidator&Validator;

    public function notSymbolicLink(): ChainedValidator&Validator;

    public function notTime(string $format = 'H:i:s'): ChainedValidator&Validator;

    public function notTld(): ChainedValidator&Validator;

    public function notTrueVal(): ChainedValidator&Validator;

    public function notUnique(): ChainedValidator&Validator;

    public function notUploaded(): ChainedValidator&Validator;

    public function notUppercase(): ChainedValidator&Validator;

    public function notUrl(): ChainedValidator&Validator;

    public function notUuid(?int $version = null): ChainedValidator&Validator;

    public function notVersion(): ChainedValidator&Validator;

    public function notVideoUrl(?string $service = null): ChainedValidator&Validator;

    public function notVowel(string ...$additionalChars): ChainedValidator&Validator;

    public function notWhen(
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator&Validator;

    public function notWritable(): ChainedValidator&Validator;

    public function notXdigit(string ...$additionalChars): ChainedValidator&Validator;

    public function notYes(bool $useLocale = false): ChainedValidator&Validator;
}
