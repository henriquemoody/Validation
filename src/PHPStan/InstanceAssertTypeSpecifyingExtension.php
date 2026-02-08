<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\PHPStan;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\Instanceof_;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Analyser\SpecifiedTypes;
use PHPStan\Analyser\TypeSpecifier;
use PHPStan\Analyser\TypeSpecifierAwareExtension;
use PHPStan\Analyser\TypeSpecifierContext;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\MethodTypeSpecifyingExtension;

final class InstanceAssertTypeSpecifyingExtension implements MethodTypeSpecifyingExtension, TypeSpecifierAwareExtension
{
    private const TYPE_FUNCTION_MAP = [
        'arrayType' => 'is_array',
        'boolType' => 'is_bool',
        'callableType' => 'is_callable',
        'floatType' => 'is_float',
        'intType' => 'is_int',
        'iterableType' => 'is_iterable',
        'nullType' => 'is_null',
        'objectType' => 'is_object',
        'resourceType' => 'is_resource',
        'stringType' => 'is_string',
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
            && $this->findTypeCheckCall($node->var) !== null;
    }

    public function specifyTypes(
        MethodReflection $methodReflection,
        MethodCall $node,
        Scope $scope,
        TypeSpecifierContext $context,
    ): SpecifiedTypes {
        $typeCheckCall = $this->findTypeCheckCall($node->var);
        if ($typeCheckCall === null) {
            return new SpecifiedTypes();
        }

        $assertedArg = $node->getArgs()[0]->value;
        $expression = $this->createExpression($typeCheckCall, $assertedArg);
        if ($expression === null) {
            return new SpecifiedTypes();
        }

        return $this->typeSpecifier->specifyTypesInCondition(
            $scope,
            $expression,
            TypeSpecifierContext::createTruthy(),
        );
    }

    private function createExpression(StaticCall|MethodCall $call, Expr $assertedArg): ?Expr
    {
        if (!$call->name instanceof Identifier) {
            return null;
        }

        $methodName = $call->name->name;

        if ($methodName === 'instance' && $call->getArgs() !== []) {
            return new Instanceof_($assertedArg, $call->getArgs()[0]->value);
        }

        $function = self::TYPE_FUNCTION_MAP[$methodName] ?? null;
        if ($function !== null) {
            return new FuncCall(new Name($function), [new Arg($assertedArg)]);
        }

        return null;
    }

    private function findTypeCheckCall(Expr $expr): StaticCall|MethodCall|null
    {
        if (($expr instanceof StaticCall || $expr instanceof MethodCall)
            && $expr->name instanceof Identifier
            && ($expr->name->name === 'instance' || isset(self::TYPE_FUNCTION_MAP[$expr->name->name]))
        ) {
            return $expr;
        }

        if ($expr instanceof MethodCall) {
            return $this->findTypeCheckCall($expr->var);
        }

        return null;
    }
}
