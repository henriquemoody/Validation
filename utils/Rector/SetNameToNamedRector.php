<?php

declare(strict_types=1);

namespace Utils\Rector;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * Transforms ->setName() calls to v::named() wrapper
 *
 * Before: v::stringType()->setName("Name")
 * After: v::named(v::stringType(), "Name")
 */
final class SetNameToNamedRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replace ->setName() method calls with v::named() wrapper',
            [
                new CodeSample(
                    'v::stringType()->setName("Name")',
                    'v::named(v::stringType(), "Name")'
                ),
                new CodeSample(
                    'v::stringType()->intType()->setName("Name")',
                    'v::named(v::stringType()->intType(), "Name")'
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        // Only process setName() method calls
        if (!$this->isName($node->name, 'setName')) {
            return null;
        }

        // Get the name argument
        if (!isset($node->args[0]) || !$node->args[0] instanceof Arg) {
            return null;
        }

        $nameArg = $node->args[0];

        // Get the validator expression (everything before ->setName())
        $validatorExpr = $node->var;

        // Create v::named() call
        // v::named($validatorExpr, $nameArg)
        $namedCall = new StaticCall(
            new Name('v'),
            new Identifier('named'),
            [
                new Arg($validatorExpr),
                $nameArg,
            ]
        );

        return $namedCall;
    }
}

