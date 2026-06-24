<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Attributes;

use PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprIntegerNode;
use PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprStringNode;
use PHPStan\PhpDocParser\Ast\ConstExpr\ConstFetchNode;
use PHPStan\PhpDocParser\Ast\Type\ArrayShapeNode;
use PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IntersectionTypeNode;
use PHPStan\PhpDocParser\Ast\Type\NullableTypeNode;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\PhpDocParser\ParserConfig;
use Psr\SimpleCache\CacheInterface;
use ReflectionProperty;
use Respect\Validation\Validator;
use Respect\Validation\Validators\AllOf;
use Respect\Validation\Validators\AnyOf;
use Respect\Validation\Validators\Attributes;
use Respect\Validation\Validators\BoolType;
use Respect\Validation\Validators\Each;
use Respect\Validation\Validators\EachKey;
use Respect\Validation\Validators\FloatType;
use Respect\Validation\Validators\Instance;
use Respect\Validation\Validators\IntType;
use Respect\Validation\Validators\Key;
use Respect\Validation\Validators\KeyOptional;
use Respect\Validation\Validators\KeySet;
use Respect\Validation\Validators\NullOr;
use Respect\Validation\Validators\StringType;

use function array_filter;
use function array_pop;
use function array_values;
use function class_exists;
use function count;
use function explode;
use function implode;
use function interface_exists;
use function ltrim;
use function str_replace;
use function str_starts_with;
use function strtolower;

/**
 * Default implementation of TypeResolver that parses `@var` type annotations
 * using phpstan/phpdoc-parser and converts them into Validator instances.
 *
 * The parsed TypeNode AST is cached via a PSR-16 cache since docblock types
 * don't change at runtime. Validator construction happens on every call because
 * the Attributes instance (used for recursive validation) changes per validation
 * run.
 *
 * @internal
 */
final class DocblockPropertyResolver implements PropertyResolver
{
    private readonly PhpDocParser $parser;

    private readonly Lexer $lexer;

    public function __construct(
        private readonly CacheInterface $cache,
    ) {
        $config = new ParserConfig([]);
        $constExprParser = new ConstExprParser($config);
        $typeParser = new TypeParser($config, $constExprParser);
        $this->parser = new PhpDocParser($config, $typeParser, $constExprParser);
        $this->lexer = new Lexer(new ParserConfig([]));
    }

    /** @return array<Validator> */
    public function resolve(ReflectionProperty $property, Attributes $attributes): array
    {
        $typeNode = $this->parsePropertyVarType($property);
        if ($typeNode === null) {
            return [];
        }

        return $this->resolveTypeNode($typeNode, $property->class, $attributes);
    }

    private function parsePropertyVarType(ReflectionProperty $property): TypeNode|null
    {
        $cacheKey = $this->buildCacheKey($property->class, $property->name);

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $docComment = $property->getDocComment();
        if ($docComment === false) {
            $this->cache->set($cacheKey, null);

            return null;
        }

        $typeNode = $this->parseVarType($docComment);
        $this->cache->set($cacheKey, $typeNode);

        return $typeNode;
    }

    private function parseVarType(string $docComment): TypeNode|null
    {
        $tokens = new TokenIterator($this->lexer->tokenize($docComment));
        $phpDocNode = $this->parser->parse($tokens);

        $varTags = $phpDocNode->getVarTagValues();
        if ($varTags === []) {
            return null;
        }

        return $varTags[0]->type;
    }

    /** @return array<Validator> */
    private function resolveTypeNode(
        TypeNode $type,
        string $contextClass,
        Attributes $attributes,
    ): array {
        if ($type instanceof GenericTypeNode) {
            return $this->resolveGenericType($type, $contextClass, $attributes);
        }

        if ($type instanceof ArrayShapeNode) {
            return $this->resolveArrayShape($type, $contextClass, $attributes);
        }

        if ($type instanceof ArrayTypeNode) {
            $inner = $this->resolveTypeNode($type->type, $contextClass, $attributes);
            if ($inner === []) {
                return [];
            }

            return [new Each($this->compose($inner))];
        }

        if ($type instanceof NullableTypeNode) {
            $inner = $this->resolveTypeNode($type->type, $contextClass, $attributes);
            if ($inner === []) {
                return [];
            }

            return [new NullOr($this->compose($inner))];
        }

        if ($type instanceof UnionTypeNode) {
            return $this->resolveUnionType($type, $contextClass, $attributes);
        }

        if ($type instanceof IntersectionTypeNode) {
            return $this->resolveIntersectionType($type, $contextClass, $attributes);
        }

        if ($type instanceof IdentifierTypeNode) {
            return $this->resolveIdentifier($type, $contextClass, $attributes);
        }

        return [];
    }

    /** @return array<Validator> */
    private function resolveGenericType(
        GenericTypeNode $type,
        string $contextClass,
        Attributes $attributes,
    ): array {
        $baseName = strtolower($type->type->name);

        if ($baseName === 'array' || $baseName === 'non-empty-array') {
            return $this->resolveArrayGeneric($type, $contextClass, $attributes);
        }

        if ($baseName === 'list' || $baseName === 'non-empty-list') {
            $inner = $this->resolveTypeNode($type->genericTypes[0], $contextClass, $attributes);
            if ($inner === []) {
                return [];
            }

            return [new Each($this->compose($inner))];
        }

        return [];
    }

    /** @return array<Validator> */
    private function resolveArrayGeneric(
        GenericTypeNode $type,
        string $contextClass,
        Attributes $attributes,
    ): array {
        $genericTypes = $type->genericTypes;

        if (count($genericTypes) === 1) {
            $inner = $this->resolveTypeNode($genericTypes[0], $contextClass, $attributes);
            if ($inner === []) {
                return [];
            }

            return [new Each($this->compose($inner))];
        }

        if (count($genericTypes) === 2) {
            $keyValidators = $this->resolveTypeNode($genericTypes[0], $contextClass, $attributes);
            $valueValidators = $this->resolveTypeNode($genericTypes[1], $contextClass, $attributes);

            if ($valueValidators === []) {
                return [];
            }

            if ($keyValidators === []) {
                return [new Each($this->compose($valueValidators))];
            }

            return [new EachKey($this->compose($keyValidators)), new Each($this->compose($valueValidators))];
        }

        return [];
    }

    /** @return array<Validator> */
    private function resolveArrayShape(
        ArrayShapeNode $type,
        string $contextClass,
        Attributes $attributes,
    ): array {
        $validators = [];
        foreach ($type->items as $item) {
            $keyName = $this->extractKeyName($item->keyName);
            if ($keyName === null) {
                continue;
            }

            $inner = $this->resolveTypeNode($item->valueType, $contextClass, $attributes);
            if ($inner === []) {
                continue;
            }

            $composed = $this->compose($inner);
            if ($item->optional) {
                $validators[] = new KeyOptional($keyName, $composed);
            } else {
                $validators[] = new Key($keyName, $composed);
            }
        }

        if ($validators === []) {
            return [];
        }

        return [new KeySet(...$validators)];
    }

    /** @return array<Validator> */
    private function resolveUnionType(
        UnionTypeNode $type,
        string $contextClass,
        Attributes $attributes,
    ): array {
        $validators = [];
        $hasNull = false;

        foreach ($type->types as $innerType) {
            if ($innerType instanceof IdentifierTypeNode && strtolower($innerType->name) === 'null') {
                $hasNull = true;
                continue;
            }

            $resolved = $this->resolveTypeNode($innerType, $contextClass, $attributes);
            if ($resolved === []) {
                continue;
            }

            $composed = $this->compose($resolved);
            $validators[] = $composed;
        }

        if ($validators === []) {
            return [];
        }

        if ($hasNull && count($validators) === 1) {
            return [new NullOr($validators[0])];
        }

        if (count($validators) === 1) {
            return [$validators[0]];
        }

        return [new AnyOf(...$validators)];
    }

    /** @return array<Validator> */
    private function resolveIntersectionType(
        IntersectionTypeNode $type,
        string $contextClass,
        Attributes $attributes,
    ): array {
        $validators = [];
        $hasClassBranch = false;

        foreach ($type->types as $innerType) {
            $resolved = $this->resolveTypeNode($innerType, $contextClass, $attributes);
            if ($resolved === []) {
                continue;
            }

            if ($innerType instanceof IdentifierTypeNode && $this->isClassIdentifier($innerType->name, $contextClass)) {
                $hasClassBranch = true;
            }

            $validators = [...$validators, ...$resolved];
        }

        if ($validators === []) {
            return [];
        }

        if ($hasClassBranch) {
            $validators = array_values(array_filter(
                $validators,
                static fn(Validator $v): bool => !$v instanceof Attributes,
            ));
            $validators[] = $attributes;
        }

        return $validators;
    }

    private function isClassIdentifier(string $name, string $contextClass): bool
    {
        $lowerName = strtolower($name);

        if ($lowerName === 'string' || $lowerName === 'int' || $lowerName === 'integer') {
            return false;
        }

        if ($lowerName === 'float' || $lowerName === 'double') {
            return false;
        }

        if ($lowerName === 'bool' || $lowerName === 'boolean' || $lowerName === 'true' || $lowerName === 'false') {
            return false;
        }

        $className = $this->resolveClassName($name, $contextClass);

        return class_exists($className) || interface_exists($className);
    }

    /** @return array<Validator> */
    private function resolveIdentifier(
        IdentifierTypeNode $type,
        string $contextClass,
        Attributes $attributes,
    ): array {
        $name = $type->name;
        $lowerName = strtolower($name);

        if ($lowerName === 'string') {
            return [new StringType()];
        }

        if ($lowerName === 'int' || $lowerName === 'integer') {
            return [new IntType()];
        }

        if ($lowerName === 'float' || $lowerName === 'double') {
            return [new FloatType()];
        }

        if ($lowerName === 'bool' || $lowerName === 'boolean' || $lowerName === 'true' || $lowerName === 'false') {
            return [new BoolType()];
        }

        return $this->resolveClassIdentifier($name, $contextClass, $attributes);
    }

    /** @return array<Validator> */
    private function resolveClassIdentifier(
        string $name,
        string $contextClass,
        Attributes $attributes,
    ): array {
        $className = $this->resolveClassName($name, $contextClass);

        if (!class_exists($className) && !interface_exists($className)) {
            return [];
        }

        return [new Instance($className), $attributes];
    }

    private function extractKeyName(
        IdentifierTypeNode|ConstExprIntegerNode|ConstExprStringNode|ConstFetchNode|null $keyName,
    ): string|int|null {
        if ($keyName instanceof IdentifierTypeNode) {
            return $keyName->name;
        }

        if ($keyName instanceof ConstExprStringNode) {
            return $keyName->value;
        }

        if ($keyName instanceof ConstExprIntegerNode) {
            return (int) $keyName->value;
        }

        return null;
    }

    private function resolveClassName(string $name, string $contextClass): string
    {
        if (str_starts_with($name, '\\')) {
            return ltrim($name, '\\');
        }

        $contextNamespace = $this->getNamespace($contextClass);
        if ($contextNamespace !== '') {
            $fqn = $contextNamespace . '\\' . $name;
            if (class_exists($fqn) || interface_exists($fqn)) {
                return $fqn;
            }
        }

        return $name;
    }

    private function getNamespace(string $class): string
    {
        $parts = explode('\\', $class);
        if (count($parts) <= 1) {
            return '';
        }

        array_pop($parts);

        return implode('\\', $parts);
    }

    /** @param array<Validator> $validators */
    private function compose(array $validators): Validator
    {
        return match (count($validators)) {
            1 => $validators[0],
            default => new AllOf(...$validators),
        };
    }

    private function buildCacheKey(string $className, string $propertyName): string
    {
        return str_replace(['\\', ':'], '.', $className . '.' . $propertyName);
    }
}
