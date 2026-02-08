<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\PHPStan;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PHPStan\Analyser\Scope;
use PHPStan\Analyser\SpecifiedTypes;
use PHPStan\Analyser\TypeSpecifier;
use PHPStan\Analyser\TypeSpecifierAwareExtension;
use PHPStan\Analyser\TypeSpecifierContext;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\ArrayType;
use PHPStan\Type\BooleanType;
use PHPStan\Type\CallableType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\IterableType;
use PHPStan\Type\MethodTypeSpecifyingExtension;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\ObjectWithoutClassType;
use PHPStan\Type\ResourceType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;

final class AllTypeAssertTypeSpecifyingExtension implements MethodTypeSpecifyingExtension, TypeSpecifierAwareExtension
{
    private const TYPE_MAP = [
        'allArrayType' => ArrayType::class,
        'allBoolType' => BooleanType::class,
        'allCallableType' => CallableType::class,
        'allFloatType' => FloatType::class,
        'allIntType' => IntegerType::class,
        'allIterableType' => IterableType::class,
        'allNullType' => NullType::class,
        'allObjectType' => ObjectWithoutClassType::class,
        'allResourceType' => ResourceType::class,
        'allStringType' => StringType::class,
    ];

    private TypeSpecifier $typeSpecifier;

    public function __construct(
        private readonly string $class,
    ) {
    }

    public function setTypeSpecifier(TypeSpecifier $typeSpecifier): void
    {
        $this->typeSpecifier = $typeSpecifier;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function isMethodSupported(
        MethodReflection $methodReflection,
        MethodCall $node,
        TypeSpecifierContext $context,
    ): bool {
        if ($node->getArgs() === []) {
            return false;
        }

        $name = $methodReflection->getName();

        return ($name === 'assert' || $name === 'check')
            && $this->findAllTypeCall($node->var) !== null;
    }

    public function specifyTypes(
        MethodReflection $methodReflection,
        MethodCall $node,
        Scope $scope,
        TypeSpecifierContext $context,
    ): SpecifiedTypes {
        $allTypeCall = $this->findAllTypeCall($node->var);
        if ($allTypeCall === null) {
            return new SpecifiedTypes();
        }

        $elementType = $this->resolveElementType($allTypeCall, $scope);
        if ($elementType === null) {
            return new SpecifiedTypes();
        }

        return $this->typeSpecifier->create(
            $node->getArgs()[0]->value,
            new ArrayType(new MixedType(), $elementType),
            TypeSpecifierContext::createTruthy(),
            $scope,
        );
    }

    private function resolveElementType(StaticCall|MethodCall $call, Scope $scope): ?Type
    {
        if (!$call->name instanceof Identifier) {
            return null;
        }

        $methodName = $call->name->name;

        if ($methodName === 'allInstance' && $call->getArgs() !== []) {
            $argType = $scope->getType($call->getArgs()[0]->value);
            $classType = $argType->getClassStringObjectType();

            return $classType->isObject()->no() ? null : $classType;
        }

        $typeClass = self::TYPE_MAP[$methodName] ?? null;

        return $typeClass !== null ? new $typeClass() : null;
    }

    private function findAllTypeCall(Expr $expr): StaticCall|MethodCall|null
    {
        if (($expr instanceof StaticCall || $expr instanceof MethodCall)
            && $expr->name instanceof Identifier
            && ($expr->name->name === 'allInstance' || isset(self::TYPE_MAP[$expr->name->name]))
        ) {
            return $expr;
        }

        if ($expr instanceof MethodCall) {
            return $this->findAllTypeCall($expr->var);
        }

        return null;
    }
}
