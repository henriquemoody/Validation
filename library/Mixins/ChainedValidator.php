<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface ChainedValidator extends
    ChainedKey,
    ChainedLength,
    ChainedMax,
    ChainedMin,
    ChainedNot,
    ChainedNullOr,
    ChainedProperty,
    ChainedUndefOr
{
    public function allOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator&Validator;

    public function alnum(string ...$additionalChars): ChainedValidator&Validator;

    public function alpha(string ...$additionalChars): ChainedValidator&Validator;

    public function alwaysInvalid(): ChainedValidator&Validator;

    public function alwaysValid(): ChainedValidator&Validator;

    public function anyOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator&Validator;

    public function arrayType(): ChainedValidator&Validator;

    public function arrayVal(): ChainedValidator&Validator;

    public function base(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public function base64(): ChainedValidator&Validator;

    public function between(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public function betweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public function boolType(): ChainedValidator&Validator;

    public function boolVal(): ChainedValidator&Validator;

    public function bsn(): ChainedValidator&Validator;

    public function call(callable $callable, Validatable $rule): ChainedValidator&Validator;

    public function callableType(): ChainedValidator&Validator;

    public function callback(callable $callback, mixed ...$arguments): ChainedValidator&Validator;

    public function charset(string $charset, string ...$charsets): ChainedValidator&Validator;

    public function cnh(): ChainedValidator&Validator;

    public function cnpj(): ChainedValidator&Validator;

    public function consecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public function consonant(string ...$additionalChars): ChainedValidator&Validator;

    public function contains(mixed $containsValue, bool $identical = false): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function containsAny(array $needles, bool $identical = false): ChainedValidator&Validator;

    public function control(string ...$additionalChars): ChainedValidator&Validator;

    public function countable(): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function countryCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    public function cpf(): ChainedValidator&Validator;

    public function creditCard(string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function currencyCode(string $set = 'alpha-3'): ChainedValidator&Validator;

    public function date(string $format = 'Y-m-d'): ChainedValidator&Validator;

    public function dateTime(?string $format = null): ChainedValidator&Validator;

    public function decimal(int $decimals): ChainedValidator&Validator;

    public function digit(string ...$additionalChars): ChainedValidator&Validator;

    public function directory(): ChainedValidator&Validator;

    public function domain(bool $tldCheck = true): ChainedValidator&Validator;

    public function each(Validatable $rule): ChainedValidator&Validator;

    public function email(): ChainedValidator&Validator;

    public function endsWith(mixed $endValue, bool $identical = false): ChainedValidator&Validator;

    public function equals(mixed $compareTo): ChainedValidator&Validator;

    public function equivalent(mixed $compareTo): ChainedValidator&Validator;

    public function even(): ChainedValidator&Validator;

    public function executable(): ChainedValidator&Validator;

    public function exists(): ChainedValidator&Validator;

    public function extension(string $extension): ChainedValidator&Validator;

    public function factor(int $dividend): ChainedValidator&Validator;

    public function falseVal(): ChainedValidator&Validator;

    public function fibonacci(): ChainedValidator&Validator;

    public function file(): ChainedValidator&Validator;

    public function filterVar(int $filter, mixed $options = null): ChainedValidator&Validator;

    public function finite(): ChainedValidator&Validator;

    public function floatType(): ChainedValidator&Validator;

    public function floatVal(): ChainedValidator&Validator;

    public function graph(string ...$additionalChars): ChainedValidator&Validator;

    public function greaterThan(mixed $compareTo): ChainedValidator&Validator;

    public function greaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function hetu(): ChainedValidator&Validator;

    public function hexRgbColor(): ChainedValidator&Validator;

    public function iban(): ChainedValidator&Validator;

    public function identical(mixed $compareTo): ChainedValidator&Validator;

    public function image(): ChainedValidator&Validator;

    public function imei(): ChainedValidator&Validator;

    public function in(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public function infinite(): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public function instance(string $class): ChainedValidator&Validator;

    public function intType(): ChainedValidator&Validator;

    public function intVal(): ChainedValidator&Validator;

    public function ip(string $range = '*', ?int $options = null): ChainedValidator&Validator;

    public function isbn(): ChainedValidator&Validator;

    public function iterableType(): ChainedValidator&Validator;

    public function iterableVal(): ChainedValidator&Validator;

    public function json(): ChainedValidator&Validator;

    public function key(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public function keyExists(string|int $key): ChainedValidator&Validator;

    public function keyOptional(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public function keySet(Validatable $rule, Validatable ...$rules): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function languageCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function lazy(callable $ruleCreator): ChainedValidator&Validator;

    public function leapDate(string $format): ChainedValidator&Validator;

    public function leapYear(): ChainedValidator&Validator;

    public function length(Validatable $rule): ChainedValidator&Validator;

    public function lessThan(mixed $compareTo): ChainedValidator&Validator;

    public function lessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public function lowercase(): ChainedValidator&Validator;

    public function luhn(): ChainedValidator&Validator;

    public function macAddress(): ChainedValidator&Validator;

    public function max(Validatable $rule): ChainedValidator&Validator;

    public function maxAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public function mimetype(string $mimetype): ChainedValidator&Validator;

    public function min(Validatable $rule): ChainedValidator&Validator;

    public function minAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public function multiple(int $multipleOf): ChainedValidator&Validator;

    public function negative(): ChainedValidator&Validator;

    public function nfeAccessKey(): ChainedValidator&Validator;

    public function nif(): ChainedValidator&Validator;

    public function nip(): ChainedValidator&Validator;

    public function no(bool $useLocale = false): ChainedValidator&Validator;

    public function noWhitespace(): ChainedValidator&Validator;

    public function noneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator&Validator;

    public function not(Validatable $rule): ChainedValidator&Validator;

    public function notBlank(): ChainedValidator&Validator;

    public function notEmoji(): ChainedValidator&Validator;

    public function notEmpty(): ChainedValidator&Validator;

    public function notOptional(): ChainedValidator&Validator;

    public function nullOr(Validatable $rule): ChainedValidator&Validator;

    public function nullType(): ChainedValidator&Validator;

    /**
     * @deprecated Use {@see nullOr()} instead.
     */
    public function nullable(Validatable $rule): ChainedValidator&Validator;

    public function number(): ChainedValidator&Validator;

    public function numericVal(): ChainedValidator&Validator;

    public function objectType(): ChainedValidator&Validator;

    public function odd(): ChainedValidator&Validator;

    public function oneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator&Validator;

    /**
     * @deprecated Use {@see undefOr()} instead.
     */
    public function optional(Validatable $rule): ChainedValidator&Validator;

    public function perfectSquare(): ChainedValidator&Validator;

    public function pesel(): ChainedValidator&Validator;

    public function phone(?string $countryCode = null): ChainedValidator&Validator;

    public function phpLabel(): ChainedValidator&Validator;

    public function pis(): ChainedValidator&Validator;

    public function polishIdCard(): ChainedValidator&Validator;

    public function portugueseNif(): ChainedValidator&Validator;

    public function positive(): ChainedValidator&Validator;

    public function postalCode(string $countryCode, bool $formatted = false): ChainedValidator&Validator;

    public function primeNumber(): ChainedValidator&Validator;

    public function printable(string ...$additionalChars): ChainedValidator&Validator;

    public function property(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function propertyExists(string $propertyName): ChainedValidator&Validator;

    public function propertyOptional(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public function publicDomainSuffix(): ChainedValidator&Validator;

    public function punct(string ...$additionalChars): ChainedValidator&Validator;

    public function readable(): ChainedValidator&Validator;

    public function regex(string $regex): ChainedValidator&Validator;

    public function resourceType(): ChainedValidator&Validator;

    public function roman(): ChainedValidator&Validator;

    public function scalarVal(): ChainedValidator&Validator;

    public function size(string|int|null $minSize = null, string|int|null $maxSize = null): ChainedValidator&Validator;

    public function slug(): ChainedValidator&Validator;

    public function sorted(string $direction): ChainedValidator&Validator;

    public function space(string ...$additionalChars): ChainedValidator&Validator;

    public function startsWith(mixed $startValue, bool $identical = false): ChainedValidator&Validator;

    public function stringType(): ChainedValidator&Validator;

    public function stringVal(): ChainedValidator&Validator;

    public function subdivisionCode(string $countryCode): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public function subset(array $superset): ChainedValidator&Validator;

    public function symbolicLink(): ChainedValidator&Validator;

    public function time(string $format = 'H:i:s'): ChainedValidator&Validator;

    public function tld(): ChainedValidator&Validator;

    public function trueVal(): ChainedValidator&Validator;

    public function undefOr(Validatable $rule): ChainedValidator&Validator;

    public function unique(): ChainedValidator&Validator;

    public function uploaded(): ChainedValidator&Validator;

    public function uppercase(): ChainedValidator&Validator;

    public function url(): ChainedValidator&Validator;

    public function uuid(?int $version = null): ChainedValidator&Validator;

    public function version(): ChainedValidator&Validator;

    public function videoUrl(?string $service = null): ChainedValidator&Validator;

    public function vowel(string ...$additionalChars): ChainedValidator&Validator;

    public function when(Validatable $when, Validatable $then, ?Validatable $else = null): ChainedValidator&Validator;

    public function writable(): ChainedValidator&Validator;

    public function xdigit(string ...$additionalChars): ChainedValidator&Validator;

    public function yes(bool $useLocale = false): ChainedValidator&Validator;
}
