<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;

interface StaticValidator extends
    StaticKey,
    StaticLength,
    StaticMax,
    StaticMin,
    StaticNot,
    StaticNullOr,
    StaticProperty,
    StaticUndefOr
{
    public static function allOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function alnum(string ...$additionalChars): ChainedValidator&Validator;

    public static function alpha(string ...$additionalChars): ChainedValidator&Validator;

    public static function alwaysInvalid(): ChainedValidator&Validator;

    public static function alwaysValid(): ChainedValidator&Validator;

    public static function anyOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function arrayType(): ChainedValidator&Validator;

    public static function arrayVal(): ChainedValidator&Validator;

    public static function base(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator&Validator;

    public static function base64(): ChainedValidator&Validator;

    public static function between(mixed $minValue, mixed $maxValue): ChainedValidator&Validator;

    public static function betweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator&Validator;

    public static function boolType(): ChainedValidator&Validator;

    public static function boolVal(): ChainedValidator&Validator;

    public static function bsn(): ChainedValidator&Validator;

    public static function call(callable $callable, Validatable $rule): ChainedValidator&Validator;

    public static function callableType(): ChainedValidator&Validator;

    public static function callback(callable $callback, mixed ...$arguments): ChainedValidator&Validator;

    public static function charset(string $charset, string ...$charsets): ChainedValidator&Validator;

    public static function cnh(): ChainedValidator&Validator;

    public static function cnpj(): ChainedValidator&Validator;

    public static function consecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function consonant(string ...$additionalChars): ChainedValidator&Validator;

    public static function contains(mixed $containsValue, bool $identical = false): ChainedValidator&Validator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function containsAny(array $needles, bool $identical = false): ChainedValidator&Validator;

    public static function control(string ...$additionalChars): ChainedValidator&Validator;

    public static function countable(): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function countryCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    public static function cpf(): ChainedValidator&Validator;

    public static function creditCard(string $brand = 'Any'): ChainedValidator&Validator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function currencyCode(string $set = 'alpha-3'): ChainedValidator&Validator;

    public static function date(string $format = 'Y-m-d'): ChainedValidator&Validator;

    public static function dateTime(?string $format = null): ChainedValidator&Validator;

    public static function decimal(int $decimals): ChainedValidator&Validator;

    public static function digit(string ...$additionalChars): ChainedValidator&Validator;

    public static function directory(): ChainedValidator&Validator;

    public static function domain(bool $tldCheck = true): ChainedValidator&Validator;

    public static function each(Validatable $rule): ChainedValidator&Validator;

    public static function email(): ChainedValidator&Validator;

    public static function endsWith(mixed $endValue, bool $identical = false): ChainedValidator&Validator;

    public static function equals(mixed $compareTo): ChainedValidator&Validator;

    public static function equivalent(mixed $compareTo): ChainedValidator&Validator;

    public static function even(): ChainedValidator&Validator;

    public static function executable(): ChainedValidator&Validator;

    public static function exists(): ChainedValidator&Validator;

    public static function extension(string $extension): ChainedValidator&Validator;

    public static function factor(int $dividend): ChainedValidator&Validator;

    public static function falseVal(): ChainedValidator&Validator;

    public static function fibonacci(): ChainedValidator&Validator;

    public static function file(): ChainedValidator&Validator;

    public static function filterVar(int $filter, mixed $options = null): ChainedValidator&Validator;

    public static function finite(): ChainedValidator&Validator;

    public static function floatType(): ChainedValidator&Validator;

    public static function floatVal(): ChainedValidator&Validator;

    public static function graph(string ...$additionalChars): ChainedValidator&Validator;

    public static function greaterThan(mixed $compareTo): ChainedValidator&Validator;

    public static function greaterThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function hetu(): ChainedValidator&Validator;

    public static function hexRgbColor(): ChainedValidator&Validator;

    public static function iban(): ChainedValidator&Validator;

    public static function identical(mixed $compareTo): ChainedValidator&Validator;

    public static function image(): ChainedValidator&Validator;

    public static function imei(): ChainedValidator&Validator;

    public static function in(mixed $haystack, bool $compareIdentical = false): ChainedValidator&Validator;

    public static function infinite(): ChainedValidator&Validator;

    /**
     * @param class-string $class
     */
    public static function instance(string $class): ChainedValidator&Validator;

    public static function intType(): ChainedValidator&Validator;

    public static function intVal(): ChainedValidator&Validator;

    public static function ip(string $range = '*', ?int $options = null): ChainedValidator&Validator;

    public static function isbn(): ChainedValidator&Validator;

    public static function iterableType(): ChainedValidator&Validator;

    public static function iterableVal(): ChainedValidator&Validator;

    public static function json(): ChainedValidator&Validator;

    public static function key(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public static function keyExists(string|int $key): ChainedValidator&Validator;

    public static function keyOptional(string|int $key, Validatable $rule): ChainedValidator&Validator;

    public static function keySet(Validatable $rule, Validatable ...$rules): ChainedValidator&Validator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function languageCode(string $set = 'alpha-2'): ChainedValidator&Validator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function lazy(callable $ruleCreator): ChainedValidator&Validator;

    public static function leapDate(string $format): ChainedValidator&Validator;

    public static function leapYear(): ChainedValidator&Validator;

    public static function length(Validatable $rule): ChainedValidator&Validator;

    public static function lessThan(mixed $compareTo): ChainedValidator&Validator;

    public static function lessThanOrEqual(mixed $compareTo): ChainedValidator&Validator;

    public static function lowercase(): ChainedValidator&Validator;

    public static function luhn(): ChainedValidator&Validator;

    public static function macAddress(): ChainedValidator&Validator;

    public static function max(Validatable $rule): ChainedValidator&Validator;

    public static function maxAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public static function mimetype(string $mimetype): ChainedValidator&Validator;

    public static function min(Validatable $rule): ChainedValidator&Validator;

    public static function minAge(int $age, ?string $format = null): ChainedValidator&Validator;

    public static function multiple(int $multipleOf): ChainedValidator&Validator;

    public static function negative(): ChainedValidator&Validator;

    public static function nfeAccessKey(): ChainedValidator&Validator;

    public static function nif(): ChainedValidator&Validator;

    public static function nip(): ChainedValidator&Validator;

    public static function no(bool $useLocale = false): ChainedValidator&Validator;

    public static function noWhitespace(): ChainedValidator&Validator;

    public static function noneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    public static function not(Validatable $rule): ChainedValidator&Validator;

    public static function notBlank(): ChainedValidator&Validator;

    public static function notEmoji(): ChainedValidator&Validator;

    public static function notEmpty(): ChainedValidator&Validator;

    public static function notOptional(): ChainedValidator&Validator;

    public static function nullOr(Validatable $rule): ChainedValidator&Validator;

    public static function nullType(): ChainedValidator&Validator;

    /**
     * @deprecated Use {@see nullOr()} instead.
     */
    public static function nullable(Validatable $rule): ChainedValidator&Validator;

    public static function number(): ChainedValidator&Validator;

    public static function numericVal(): ChainedValidator&Validator;

    public static function objectType(): ChainedValidator&Validator;

    public static function odd(): ChainedValidator&Validator;

    public static function oneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator&Validator;

    /**
     * @deprecated Use {@see undefOr()} instead.
     */
    public static function optional(Validatable $rule): ChainedValidator&Validator;

    public static function perfectSquare(): ChainedValidator&Validator;

    public static function pesel(): ChainedValidator&Validator;

    public static function phone(?string $countryCode = null): ChainedValidator&Validator;

    public static function phpLabel(): ChainedValidator&Validator;

    public static function pis(): ChainedValidator&Validator;

    public static function polishIdCard(): ChainedValidator&Validator;

    public static function portugueseNif(): ChainedValidator&Validator;

    public static function positive(): ChainedValidator&Validator;

    public static function postalCode(string $countryCode, bool $formatted = false): ChainedValidator&Validator;

    public static function primeNumber(): ChainedValidator&Validator;

    public static function printable(string ...$additionalChars): ChainedValidator&Validator;

    public static function property(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function propertyExists(string $propertyName): ChainedValidator&Validator;

    public static function propertyOptional(string $propertyName, Validatable $rule): ChainedValidator&Validator;

    public static function publicDomainSuffix(): ChainedValidator&Validator;

    public static function punct(string ...$additionalChars): ChainedValidator&Validator;

    public static function readable(): ChainedValidator&Validator;

    public static function regex(string $regex): ChainedValidator&Validator;

    public static function resourceType(): ChainedValidator&Validator;

    public static function roman(): ChainedValidator&Validator;

    public static function scalarVal(): ChainedValidator&Validator;

    public static function size(
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator&Validator;

    public static function slug(): ChainedValidator&Validator;

    public static function sorted(string $direction): ChainedValidator&Validator;

    public static function space(string ...$additionalChars): ChainedValidator&Validator;

    public static function startsWith(mixed $startValue, bool $identical = false): ChainedValidator&Validator;

    public static function stringType(): ChainedValidator&Validator;

    public static function stringVal(): ChainedValidator&Validator;

    public static function subdivisionCode(string $countryCode): ChainedValidator&Validator;

    /**
     * @param mixed[] $superset
     */
    public static function subset(array $superset): ChainedValidator&Validator;

    public static function symbolicLink(): ChainedValidator&Validator;

    public static function time(string $format = 'H:i:s'): ChainedValidator&Validator;

    public static function tld(): ChainedValidator&Validator;

    public static function trueVal(): ChainedValidator&Validator;

    public static function undefOr(Validatable $rule): ChainedValidator&Validator;

    public static function unique(): ChainedValidator&Validator;

    public static function uploaded(): ChainedValidator&Validator;

    public static function uppercase(): ChainedValidator&Validator;

    public static function url(): ChainedValidator&Validator;

    public static function uuid(?int $version = null): ChainedValidator&Validator;

    public static function version(): ChainedValidator&Validator;

    public static function videoUrl(?string $service = null): ChainedValidator&Validator;

    public static function vowel(string ...$additionalChars): ChainedValidator&Validator;

    public static function when(
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator&Validator;

    public static function writable(): ChainedValidator&Validator;

    public static function xdigit(string ...$additionalChars): ChainedValidator&Validator;

    public static function yes(bool $useLocale = false): ChainedValidator&Validator;
}
